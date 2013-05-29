<?php
/**
 * @version 1.5
 * @package Tienda
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

MediaManager::load( 'MediaManagerHelperBase', 'helpers.base' );
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class MediaManagerHelperMedia extends DSCHelper
{

   /**
     * Returns array of filenames
     * Array
     * (
     *     [0] => airmac.png
     *     [1] => airportdisk.png
     *     [2] => applepowerbook.png
     *     [3] => cdr.png
     *     [4] => cdrw.png
     *     [5] => cinemadisplay.png
     *     [6] => floppy.png
     *     [7] => macmini.png
     *     [8] => shirt1.jpg
     * )
     * @param $folder
     * @return array
     */
    function getGalleryImages( $folder=null, $options=array() )
    {
        $images = array();
        
        if (empty($folder))
        {
            return $images;
        }
        if (empty( $options['exclude'] ))
        {
            $options['exclude'] = array();
        }
            elseif (!is_array($options['exclude']))
        {
            $options['exclude'] = array($options['exclude']);
        }
        
        if (JFolder::exists( $folder ))
        {
            $extensions = array( 'png', 'gif', 'jpg', 'jpeg' );
            
            $files = JFolder::files( $folder );
            foreach ($files as $file)
            {
                $namebits = explode('.', $file);
                $extension = strtolower( $namebits[count($namebits)-1] );
                if (in_array($extension, $extensions))
                {
                    if (!in_array($file, $options['exclude']))
                    {
                        $images[] = $file;
                    }
                }
            }
        }      
        return $images;
    }
    /**
     * Returns the full path to the product's image gallery files
     * 
     * @param int $id
     * @return string
     */
    function getGalleryPath( $id )
    {
        static $paths;
        
        $id = (int) $id;
        
        if (!is_array($paths)) { $paths = array(); }
        
        if (empty($paths[$id]))
        {
            $paths[$id] = '';
            
            JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
            $row = JTable::getInstance('Media', 'MediaManagerTable');
            $row->load( (int) $id );
            if (empty($row->media_id))
            {
                // TODO figure out what to do if the id is invalid 
                return null;
            }

            $paths[$id] = $row->getImagePath(true);
        }
       
        return $paths[$id];
    }
    
	/**
	 * Gets user state of selected values
	 * 
	 * @return return_type
	 */
	function getState()
	{
	    $defines = Mediamanager::getInstance();
	    
	    if (empty($this->state))
	    {
	        $request = JRequest::get('request');
	        
	        $db = JFactory::getDBO();
	        $session = JFactory::getSession();
	        $app = JFactory::getApplication();
            $ns = $app->getName().'::'.'com.mediamanager.state';

    	    $state = array();
    	    // $state['primary_categories'] = array() of IDs // custom for BGL
    	    // $state['secondary_category'] = array() of IDs // custom for BGL
    	    // $state['library_id'] = int
    	    // $state['filter_categories'] = array() of IDs
    	    // $state['filter_groups'] = array() of IDs
    	    // $state['filter_date_from'] = string
    	    // $state['filter_date_to'] = string
    	    // $state['filter_tag'] = int
    	    // $state['limit'] = int // pagination limit
    	    // $state['order'] = string // sort ordering
    	    // $state['filter_enabled'] = 1

    	    // working vars
    	    $filter_librarycategories = array();
    	    $filter_librarygroups = array();
    	    $filter_categories = array();
    	    $filter_groups = array();
    	    $filter_date_from = '';
    	    $filter_date_to = '';
    	    $limit = $defines->get( 'library_pagination_limit', $app->getCfg('list_limit', '20') );
    	    $order = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.date_added', 'cmd');
    	        	    
    	    $library_id = JRequest::getInt('library_id');
    	    if (empty($library_id)) {
    	        $library_id = $session->get( $ns . '.library_id' );
    	    }
    	    
    	    if (!empty($library_id)) 
    	    {
    	        JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
    	        $library_model = JModel::getInstance( 'Libraries', 'MediamanagerModel' );
    	        $library_model->setId( $library_id );
    	        $library = $library_model->getItem($library_id);
    	        
    	        // apply defaults from the library, including filters for: date-added, categories, and tags
    	        $filter_librarycategories = $library->categories;
    	        $filter_librarygroups = $library->groups;
    	        $filter_date_from = $library->library_date_from;
    	        $filter_date_to = $library->library_date_to;    	
    	        $limit = !empty($library->library_pagination_limit) ? $library->library_pagination_limit : $limit;
    	    }
    	    
    	    $filter_tag = JRequest::getInt('tag_id');
    	    if (empty($filter_tag)) {
    	        $filter_tag = $session->get( $ns . '.filter_tag' );
    	    }
    	        	    
    	    /**
    	     * 
    	     * Ok, defaults are all set, now lets check the user state
    	     */
    	    
    	    $view = JRequest::getVar( 'view' );
            $reset = JRequest::getVar('reset');
            $v = JRequest::getVar('v'); // originally used by ajax requests from module
            
            //$categories = JRequest::getVar('filter_categories', array(), 'request', 'array');
            
            //$primary_categories = array();
            //$secondary_category = $session->get( $ns . '.secondary_category' );
            
        	// if the view == media/item, the user is viewing an item, so use the previous state values
            // otherwise, update the state values
            if ($reset == '1')
            {
                //$secondary_category = '';
                //$session->set( $ns . '.categories', array() );
                //$session->set( $ns . '.secondary_category', $secondary_category );
                $session->set( $ns . '.library_id', $library_id );
                $session->set( $ns . '.filter_categories', $filter_categories );
                $session->set( $ns . '.filter_groups', $filter_groups );
                $session->set( $ns . '.filter_librarycategories', $filter_librarycategories );
                $session->set( $ns . '.filter_librarygroups', $filter_librarygroups );
                $session->set( $ns . '.filter_date_from', $filter_date_from );
                $session->set( $ns . '.filter_date_to', $filter_date_to );
                $session->set( $ns . '.filter_tag', $filter_tag );
                $state['limitstart'] = 0;
                $state['start'] = 0;
                $app->setUserState('limitstart', $state['limitstart']);
                $app->setUserState('start', $state['start']);
            }
            elseif ($v=='2')
            {
                //echo "Ajax Update, so using json values<br/>";
                // we're doing an ajax update
        		$values = $this->getSelectedValues();
        		/*
        		if (!empty($values['categories']))
        		{
        		    $primary_categories = $values['categories'];
        		}
        		
        		if (!empty($values['_checked']['secondary_category']))
        		{
        		    $secondary_category = $values['_checked']['secondary_category'];
        		} 
        		*/       		
                
                //$session->set( $ns . '.categories', $primary_categories );
                //$session->set( $ns . '.secondary_category', $secondary_category );
                $session->set( $ns . '.library_id', $library_id );
                $session->set( $ns . '.filter_categories', $filter_categories );
                $session->set( $ns . '.filter_groups', $filter_groups );
                $session->set( $ns . '.filter_librarycategories', $filter_librarycategories );
                $session->set( $ns . '.filter_librarygroups', $filter_librarygroups );
                $session->set( $ns . '.filter_date_from', $filter_date_from );
                $session->set( $ns . '.filter_date_to', $filter_date_to );
                $session->set( $ns . '.filter_tag', $filter_tag );
            }
	        elseif ($view == "media" || $view == "item")
            {
                //echo "View == media, so using previous state<br/>";
                //$primary_categories = $session->get( $ns . '.categories', $primary_categories );
                //$secondary_category = $session->get( $ns . '.secondary_category', $secondary_category );
                $library_id = $session->get( $ns . '.library_id' );
                $filter_categories = $session->get( $ns . '.filter_categories' );
                $filter_groups = $session->get( $ns . '.filter_groups' );
                $filter_librarycategories = $session->get( $ns . '.filter_librarycategories' );
                $filter_librarygroups = $session->get( $ns . '.filter_librarygroups' );
                $filter_date_from = $session->get( $ns . '.filter_date_from' );
                $filter_date_to = $session->get( $ns . '.filter_date_to' );
                $filter_tag = $session->get( $ns . '.filter_tag' );
            }
            else
            {
                // just browsing, use the dynamic filterable states, not anything else
                //$primary_categories = $session->get( $ns . '.categories' );
                //$secondary_category = $session->get( $ns . '.secondary_category' );
                $library_id = $session->get( $ns . '.library_id' );
                $filter_categories = $session->get( $ns . '.filter_categories' );
                $filter_groups = $session->get( $ns . '.filter_groups' );
                $filter_librarycategories = $session->get( $ns . '.filter_librarycategories' );
                $filter_librarygroups = $session->get( $ns . '.filter_librarygroups' );
                $filter_date_from = $session->get( $ns . '.filter_date_from' );
                $filter_date_to = $session->get( $ns . '.filter_date_to' );
                $filter_tag = $session->get( $ns . '.filter_tag' );
                
                $toggles = array();
                if (!empty($request['filter_toggle'])) {
                    $toggles = $request['filter_toggle'];
                }
                foreach ($toggles as $toggle_type=>$toggle_value)
                {
                    switch ($toggle_type) {
                        case "group":
                            if (in_array($toggle_value, $filter_groups)) {
                                $key = array_search($toggle_value, $filter_groups);
                                unset($filter_groups[$key]);
                            } else {
                                $filter_groups[] = $toggle_value;
                            }
                            break;
                        case "category":
                            if (in_array($toggle_value, $filter_categories)) {
                                $key = array_search($toggle_value, $filter_categories);
                                unset($filter_categories[$key]);
                            } else {
                                $filter_categories[] = $toggle_value;
                            }
                            break;
                    }
                }
                $session->set( $ns . '.filter_groups', $filter_groups );
                $session->set( $ns . '.filter_categories', $filter_categories );
            }
            
            /*
            if (empty($secondary_category))
            {
                $secondary_category = 'all';
            }
            
            if (!empty($categories))
            {
                if (is_array($primary_categories) && !in_array($categories[0], $primary_categories))
                {
                    $primary_categories[] = $categories[0];
                    $session->set( $ns . '.categories', $primary_categories );
                } 
                    elseif (!is_array($primary_categories))
                {
                    $primary_categories = array();
                    $primary_categories[] = $categories[0];
                    $session->set( $ns . '.categories', $primary_categories );
                }
            }

            if (!empty($primary_categories)) 
            {
                foreach ($primary_categories as $key=>$pc)
                {
                    if (empty($pc)) {
                        unset($primary_categories[$key] );
                    }
                }
            }
            */
            
    	    //$state['categories'] = (array) $primary_categories;
    	    //$state['secondary_category'] = $secondary_category;
            $state['values'] = @$values;
            $state['library_id'] = $library_id;
            $state['filter_categories'] = $filter_categories;
            $state['filter_librarycategories'] = (array) $filter_librarycategories;
            $state['filter_groups'] = (array) $filter_groups;
            $state['filter_librarygroups'] = (array) $filter_librarygroups;
            $state['filter_date_from'] = $filter_date_from;
            $state['filter_date_to'] = $filter_date_to;
            $state['filter_tag'] = $filter_tag;
            $state['limit'] = $limit;
            $state['filter_enabled'] = 1;
            $state['order'] = 'tbl.date_added';
            $state['direction'] = 'DESC';
            
    	    $this->state = $state;
	    }

	    return $this->state;
	}
	
	/**
	 * Gets values submitted by ajax request
	 * @return return_type
	 */
	function getSelectedValues()
	{
	    if (empty($this->values))
	    {
    		$elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );
    		MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
    		$helper = new MediaManagerHelperBase();
    		$values = $helper->elementsToArray( $elements );
            $this->values = $values;	        
	    }
	    return $this->values;
	}
}