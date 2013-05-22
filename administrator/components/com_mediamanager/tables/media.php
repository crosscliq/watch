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

class MediamanagerTableMedia extends DSCTable 
{ 
	function MediamanagerTableMedia( &$db ) 
	{
		$tbl_key 	= 'media_id';
		$tbl_suffix = 'media';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}

	/**
	 * Get the path to the product current Image
	 * @return string $dir
	 */
	function getImagePath($check = true)
	{

		// Check where we should upload the file
		// This is the default one
		$dir = MediaManager::getPath( 'siteImages' );

		MediaManager::load( 'MediaManagerHelperBase', 'helpers.base' );
		$helper = new MediaManagerHelperBase();

		// default.path.media_title check to see if it exists and if not create it 
		if ($helper->checkDirectory($dir.DS.$this->media_id, $check))
		{
			//once found set as the upload directory and pass back 
			$dir = $dir.DS.$this->media_id;
		}

		return $dir;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $check
	 * @return return_type
	 */
	function getAudioPath($check = true)
	{

		// Check where we should upload the file
		// This is the default one
		$dir = MediaManager::getPath( 'siteAudio' );

		MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' ); 
		$helper = new MediaManagerHelperBase();

		// default.path.media_title check to see if it exists and if not create it 
		if($helper->checkDirectory($dir.DS.$this->media_id, $check))
		{
			//once found set as the upload directory and pass back 
			$dir = $dir.DS.$this->media_id;
		}

		return $dir;
	}
	
    /**
     * Get the URL to the path to images
     * @return unknown_type
     */
    function getImageUrl()
    {
        // Check where we should upload the file
        // This is the default one
        $dir = MediaManager::getPath( 'siteImages' );
        
        $url = MediaManager::getUrl('siteImages');

        MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
        $helper = new MediaManagerHelperBase();
        
        if ($helper->checkDirectory($dir.DS.$this->media_id, false))
        {
            $url = $url . $this->media_id . "/";
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
        $dir = $dir . DS . 'thumbs';
        
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
            // Delete each of the mediafiles
            JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
            $model = JModel::getInstance('MediaFiles', 'MediaManagerModel');
            $model->setState( 'filter_media', $properties['media_id'] );
            if ($items = $model->getList(true))
            {
                JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
                foreach ($items as $item)
                {
                    $mediafile = JTable::getInstance('MediaFiles', 'MediamanagerTable');
                    if (!$mediafile->delete( $item->mediafile_id ))
                    {
                        JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                    }
                }
            }
            
            // delete tags
            $query = "DELETE FROM #__mediamanager_mediatags WHERE media_id = '".$properties['media_id']."';";
            $db = $this->getDBO();
            $db->setQuery( $query );
            $db->query();
        }
        return $return;
    }
    
    function check()
    {
        $db = $this->getDBO();
        $nullDate = $db->getNullDate( );
        $date = JFactory::getDate( );
    	if (empty($this->date_added) || $this->date_added == '0000-00-00' || $this->date_added == $nullDate )
		{
		    
			$this->date_added = $date->toMySQL();
		}

        $this->datemodified = $date->toSql( );
		
		return true;
    }
}