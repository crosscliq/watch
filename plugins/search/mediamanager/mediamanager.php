<?php
/**
 * @version	1.5
 * @package	Mediamanager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

/** Import library dependencies */
jimport('joomla.plugin.plugin');

class plgSearchMediamanager extends JPlugin 
{   
    function plgSearchMediamanager(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }
    
    /**
     * Checks the extension is installed
     * 
     * @return boolean
     */
    function _isInstalled()
    {
        $success = false;
        
        jimport('joomla.filesystem.file');
        if (JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'defines.php')) 
        {
            $success = true;
            if ( !class_exists('Mediamanager') ) {
                JLoader::register( "Mediamanager", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );
                JLoader::register( "MediamanagerConfig", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );
            }
        }
        return $success;
    }
    
    /**
     * Tells the seach component what extentions are being searched
     * 
     * @return unknown_type
     */
    function onSearchAreas()
    {
        if (!$this->_isInstalled())
        {
            // TODO Find out if this should return null or array
            return array();
        }
        
        $areas = 
            array(
                'mediamanager' => $this->params->get('title', "Mediamanager")
            );
        return $areas;
    }
    
    /**
     * Performs the search
     * 
     * @param string $keyword
     * @param string $match
     * @param unknown_type $ordering
     * @param unknown_type $areas
     * @return unknown_type
     */    
    function onSearch( $keyword='', $match='', $ordering='', $areas=null )
    {
        if (!$this->_isInstalled())
        {
            return array();
        }
        
        if ( is_array( $areas ) ) 
        {
            if ( !array_intersect( $areas, array_keys( $this->onSearch() ) ) ) 
            {
                return array();
            }
        }
        
        $keyword = trim( $keyword );
        if (empty($keyword)) 
        {
            return array();
        }
        
        JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
        JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
        $model = JModel::getInstance( 'Media', 'MediamanagerModel' );
        $match = strtolower($match);
        switch ($match)
        {
            case 'exact':
                $model->setState('filter', $match);
            case 'all':
            case 'any':
            default:
                $words = explode( ' ', $keyword );
                $wheres = array();
                foreach ($words as $word)
                {
                    $model->setState('filter', $word);
                }
                break;
        }
        
        // order the items according to the ordering selected in com_search
        switch ( $ordering ) 
        {
            case 'newest':
                $model->setState('order', 'tbl.date_added');
                $model->setState('direction', 'DESC');
                break;
            case 'oldest':
                $model->setState('order', 'tbl.date_added');
                $model->setState('direction', 'ASC');
                break;
            case 'popular':
                $model->setState('order', 'tbl.hits');
                $model->setState('direction', 'DESC');
                break;
            case 'alpha':
            default:
                $model->setState('order', 'tbl.media_title');
                $model->setState('direction', 'ASC');
                break;
        }

        $model->setState('filter_enabled', '1');
        $items = $model->getList();
        if (empty($items)) { return array(); }
 
        MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
        $helper = MediaManagerHelperBase::getInstance();
        
        $config = MediamanagerConfig::getInstance( );
        $library_id = $config->get( 'library_id' );
        $jdate = JFactory::getDate();
        $date = $jdate->toFormat('%Y-%m-%d');
        // format the items array according to what com_search expects
        foreach ($items as $key => $item)
        {
            $item->href         = "index.php?option=com_mediamanager&view=media&id=" . $item->media_id . "&library_id=" . $library_id . "&Itemid=" . $config->get( 'item_id' );
            $item->title        = $item->media_title;
            $item->created      = $item->date_added;
            $item->section      = JText::_( $this->params->get('title', "Mediamanager") );
            $item->text         = $helper->truncateString( $item->media_description );
            $item->image        = "<img src='". $item->media_image_remote ."' alt='". $item->media_title ."' />";
            $item->browsernav   = "1";
        }

        return $items;
    }
}
?>