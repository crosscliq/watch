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

 

class MediamanagerTableTags extends DSCTable 
{ 
	function MediamanagerTableTags( &$db ) 
	{
		$tbl_key 	= 'tag_id';
		$tbl_suffix = 'tags';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function delete( $oid=null )
	{
		if (!$oid) {
		    $k = $this->_tbl_key;
			$oid = (int) $this->$k;
		}
		
		if ( $return = parent::delete( $oid ))
		{
            // Delete all references to this tag
            $query = "DELETE FROM #__mediamanager_mediatags WHERE tag_id = '$oid';";
            $db = $this->getDBO();
            $db->setQuery( $query );
            $db->query();
		}
		return $return;
	}
	
	function exists( $title=null )
	{
	    if (empty($title))
	    {
	        $title = $this->tag_title;
	    }
	    $title = strtolower( $title );
	    
        $db = $this->getDBO();
        $query = "SELECT * FROM #__mediamanager_tags WHERE LOWER(`tag_title`) = '$title';";
        $db->setQuery( $query );
        $result = $db->loadObject();
	    if (!empty($result->tag_id))
	    {
	        if (!empty($this) && is_object($this))
	        {
	            $this->tag_id = $result->tag_id;
	            $this->tag_title = $result->tag_title;
	        }
	        return true;
	    }
	    
	    return false;
	}
}