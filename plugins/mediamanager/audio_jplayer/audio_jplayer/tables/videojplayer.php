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

class MediaManagerTableAudioJplayer extends DSCTable 
{ 
	function MediaManagerTableAudioJplayer( &$db ) 
	{
        $keynames = array(); 
        $keynames['audiojplayer_id'] = 'audiojplayer_id'; 
        $keynames['media_id'] = 'media_id';
        $this->setKeyNames($keynames);
        
		$tbl_key 	= 'audiojplayer_id';
		$tbl_suffix = 'audio_jplayer';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";		
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
    function check()
    {
        if (empty($this->media_id))
        {
            $this->setError( JText::_( "MEDIA ID REQUIRED" ) );
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
            JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
            $mediafile = JTable::getInstance('MediaFiles', 'MediaManagerTable');
            if (!$mediafile->delete( $properties['mediafile_id'] ))
            {
                JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                $return = false;
            }
        }
        return $return;
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

		//get instance of helper to check and create paths if required 
		$helper = new MediaManagerHelperBase();

		// default.path.media_title check to see if it exists and if not create it 
		if($helper->checkDirectory($dir.DS.$this->media_id, $check))
		{
			//once found set as the upload directory and pass back 
			$dir = $dir.DS.$this->media_id.DS;
		}

		return $dir;
	}
	
    /**
     * (non-PHPdoc)
     * @see database/JTable::reorder()
     */
    function reorder( $where='' )
    {
        parent::reorder( "media_id = '$this->media_id'" );
    }
}