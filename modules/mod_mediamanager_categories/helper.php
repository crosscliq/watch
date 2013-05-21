<?php
/**
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2009 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/*ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted Access' );
jimport( 'joomla.application.component.model' );

class modMediaManagerCategoriesHelper extends JObject
{
	/**
	 * Sets the modules params as a property of the object
	 * @param unknown_type $params
	 * @return unknown_type
	 */
	function __construct( $params )
	{
		$this->params = $params;
		
		if ( !class_exists( 'MediaManager' ) ) JLoader::register( "MediaManager", JPATH_ADMINISTRATOR . DS . "components" . DS . "com_mediamanager" . DS . "defines.php" );
		MediaManager::load( 'MediaManagerConfig', 'defines' );
		
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
	}
	
	/**
	 * Gets the various db information to sucessfully display item
	 * @return unknown_type
	 */
	function getItem( $id )
	{
		$model = JModel::getInstance( 'Libraries', 'MediaManagerModel' );
		
		$model->setId( ( int ) $id );
		$row = $model->getItem( );
		
		return $row;
	}
	
	/**
	 * Get the neccesary logic for the specific plugin ...
	 * @param unknown_type $item
	 * @return unknown_type
	 */
	function getPrimaryCategories( $library_id='' )
	{
	    if (empty($library_id))
	    {
    		$model = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
    		$model->setState( 'order', 'tbl.ordering' );
    		$model->setState( 'direction', 'ASC' );
            $items = $model->getList();
            return $items;
	    }
	    
		$model = JModel::getInstance( 'LibraryCategoryTypes', 'MediaManagerModel' );
		$model->setState( 'filter_library', $library_id );
		$model->setState( 'order', 'ct.ordering' );
		$model->setState( 'direction', 'ASC' );
        $items = $model->getList();
        return $items;	    
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return return_type
	 */
    function getState()
    {
        if (empty($this->state))
        {
            MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
            $helper = MediaManagerHelperBase::getInstance( 'media' );
            $this->state = $helper->getState();
        }
        
        return $this->state;
    }
    
	/**
	 * Get the neccesary logic for the specific plugin ...
	 * @param unknown_type $item
	 * @return unknown_type
	 */
	function getSecondaryCategories()
	{
        $state = $this->getState();
        
        $media_model = JModel::getInstance( 'Media', 'MediaManagerModel' );
		$media_model->setState( 'filter_enabled', '1' );

		$lcmodel = JModel::getInstance( 'LibraryCategories', 'MediaManagerModel' );
		$lcmodel->setState('filter_library', $state['library_id'] );
		$lcategories = $lcmodel->getList();
		$lcats = MediaManagerHelperBase::getColumn( $lcategories, 'category_id' );
		$media_model->setState( 'filter_categories', $lcats );
		
		$query = $media_model->getQuery();
		
		$where = array();
		$ctmodel = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
		$ctmodel->setState('get_categories', true);
        $items = $ctmodel->getList(false);
        foreach ($items as $ct)
        {
            $ct_cats = MediaManagerHelperBase::getColumn( $ct->categories, 'category_id' );
            // if no filters in this group are applied, then all of them are applied if they're part of the library definition
            if ($categories = array_intersect($ct_cats, $state['categories']))
            {
                $where[] = "(SELECT COUNT(*) FROM jos_mediamanager_mediacategories AS mediacats WHERE tbl.media_id = mediacats.media_id AND mediacats.category_id IN ('" . implode( "', '", $categories) . "') )";                        
            }
        }

        if (!empty($where))
        {
            $query->where( '(' . implode( ' AND ', $where ) . ')' );
        }
        $media_model->setQuery( $query );   
		
        $list = $media_model->getList();
        
        $all_types = MediaManagerHelperBase::getColumn( $list, 'media_type' );
        $types = array_unique($all_types);
        
        $sc = array();
        $sc[] = 'all';
        foreach ($types as $type)
        {
            $exploded = explode('_', $type);
            $sc[] = $exploded[0];
        }
        
        $return = array();
        foreach ($sc as $c)
        {
            $item = new JObject;
            $item->checked = ($state['secondary_category'] == $c) ? true : false;
            $item->id = $c;
            $item->title = ucwords( $c );
            $count = 0;
            foreach ($all_types as $at)
            {
                $exploded = explode('_', $at);
                if ($c == 'all') { $count++; }
                elseif (strtolower($exploded[0]) == $c) { $count++; } 
            }
            $item->count = $count; 
            $return[] = $item;
        }
        
        return $return;
	}
}
?>