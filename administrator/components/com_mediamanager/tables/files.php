<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
 
/** ensure this file is being included by a parent file */
defined('_JEXEC')or die('Restricted Access'); 

class MediamanagerTableFiles extends DSCTable 
{ 
	function MediamanagerTableFiles( &$db ) 
	{
		$tbl_key 	= 'file_id';
		$tbl_suffix = 'files';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check()
	{
	    // if in the path is JPATH_ROOT, then remove it
	    $this->file_path = str_replace( JPATH_ROOT, '', $this->file_path );
	    
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
            $errors = array();
            
            // physically delete file
            $path = JPATH_ROOT . $properties['file_path'];
            $image = $properties['file_name'];
            
            // Delete the local file if it exists
            if (JFile::exists($path.$image))
            {
                $success = JFile::delete( $path.$image );
                if (!$success)
                {
                    $errors[] = JText::_('Could not Delete the File') . ': ' . $path.$image ;
                }
            }
            
            // Try to delete the thumb, too
            if (JFile::exists($path.'thumbs'.DS.$image))
            {
                if (!JFile::delete($path.'thumbs'.DS.$image))
                {
                    $errors[] = JText::_('Could not Delete the Thumb') . ': ' . $path.'thumbs'.DS.$image ;
                }
            }

            if (!empty($errors)) 
            {
                $msg = "";
                foreach ($errors as $error) 
                {
                    $msg .= $error . "<br/>";
                }
                $this->setError( $msg );
                
                return false;
            }
        }
        
        return $return;
    }
    
    /**
     * Finds and loads the file with the 
     * @param $file_name
     * @param $media_id
     * @return unknown_type
     */
    function loadExistingFile( $file_name, $media_id )
    {
        // find the file_id where the file has this name and the file is a mediafile for this media_id
        JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
        $model = JModel::getInstance('MediaFiles', 'MediaManagerModel');
        $model->setState( 'filter_media', $media_id );
        $model->setState( 'filter_filename', $file_name );
        if ($list = $model->getList())
        {
            $item = $list[0];
            $this->load( $item->file_id );
            return true;
        }
        return false;
    }
    
    /**
    * Get the path to the product current Image
    * @return string $dir
    */
    function getFilePath($check = true)
    {
    
        // Check where we should upload the file
        // This is the default one
        $dir = MediaManager::getPath( 'siteFiles' );
    
        MediaManager::load( 'MediaManagerHelperBase', 'helpers.base' );
        $helper = new MediaManagerHelperBase();
    
        // default.path.media_title check to see if it exists and if not create it
        if ($helper->checkDirectory($dir . DS . $this->file_id, $check))
        {
            //once found set as the upload directory and pass back
            $dir = $dir . DS . $this->file_id;
        }
    
        return $dir;
    }
    
    /**
     * Get the URL to the path to images
     * @return unknown_type
     */
    function getFileUrl()
    {
        // Check where we should upload the file
        // This is the default one
        $dir = MediaManager::getPath( 'siteFiles' );
    
        $url = MediaManager::getUrl('siteFiles');
    
        MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
        $helper = new MediaManagerHelperBase();
    
        if ($helper->checkDirectory($dir . DS . $this->file_id, false))
        {
            $url = $url . $this->file_id . "/";
        }
    
        return $url;
    }
    
    /**
     * Get the path to the item current Image
     * @return string $dir
     */
    function getThumbPath($check = true)
    {
        $dir = $this->getImagePath($check);
        $dir = $dir . DS .'thumbs';
    
        return $dir;
    }
    
    /**
     * Get the URL to the path to images
     * @return unknown_type
     */
    function getThumbUrl()
    {
        $url = $this->getImageUrl();
        $url = $url .'thumbs/';
    
        return $url;
    }
}