<?php
/**
 * @version 1.5
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
 
/** ensure this file is being included by a parent file */
defined('_JEXEC')or die('Restricted Access'); 

 

class MediamanagerTableMediaFiles extends DSCTable 
{ 
    function MediamanagerTableMediaFiles( &$db ) 
    {
        $tbl_key    = 'mediafile_id';
        $tbl_suffix = 'mediafiles';
        $name       = 'mediamanager';
        
        $this->set( '_tbl_key', $tbl_key );
        $this->set( '_suffix', $tbl_suffix );
        
        parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );   
    }
    
    function check()
    {
        if (empty($this->file_id))
        {
            $this->setError( JText::_( "File Required" ) );
            return false;
        }
        if (empty($this->media_id))
        {
            $this->setError( JText::_( "Media Required" ) );
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * @param $oid
     * @return unknown_type
     */
    function delete( $oid=null )
    {
        if (!empty($oid))
        {
            $this->load( $oid );
        }
        $properties = $this->getProperties();
        
        if ( $return = parent::delete( $oid ))
        {
            // If this is the last media using this file_id, then delete the file_id from the #__files DB
            if ($this->isLast( $properties['file_id'] ))
            {
                JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
                $file = JTable::getInstance('Files', 'MediamanagerTable');
                if (!$file->delete( $properties['file_id'] ))
                {
                    JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
                    $return = false;
                }
            }
        }
        return $return;
    }
    
    /**
     * Determines if there are any records in mediafiles for the provided file_id
     * @param $file_id
     * @return unknown_type
     */
    function isLast( $file_id )
    {
        JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
        $model = JModel::getInstance('MediaFiles', 'MediaManagerModel');
        $model->setState( 'filter_file', $file_id );
        if ($list = $model->getList(true))
        {
            return false;
        }
        return true;
    }
}	
