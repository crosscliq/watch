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

 

class MediamanagerTableMediaTags extends DSCTable 
{ 
	function MediamanagerTableMediaTags ( &$db ) 
	{
		$tbl_key 	= 'mediatag_id';
		$tbl_suffix = 'mediatags';
		$name 		= 'mediamanager';
		
		$this->set( '_tbl_key', $tbl_key );
		$this->set( '_suffix', $tbl_suffix );
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check()
	{
		if (empty($this->tag_id))
		{
			$this->setError( JText::_( "Tag Required" ) );
			return false;
		}
		if (empty($this->media_id))
		{
			$this->setError( JText::_( "Media Required" ) );
			return false;
		}
		
		if ($this->relationshipExists( $this->media_id, $this->tag_id ))
		{
			$this->setError( JText::_( "Relationship Already Exists" ) );
			return false;		    
		}
		
		return true;
	}
	
	function relationshipExists( $media_id, $tag_id )
	{
	    $exists = JTable::getInstance( 'MediaTags', 'MediamanagerTable' );
	    $exists->load( array( 'media_id'=>$media_id, 'tag_id'=>$tag_id ) );
	    if (!empty($exists->mediatag_id))
	    {
	        return true;
	    }
	    return false;
	}
}
	