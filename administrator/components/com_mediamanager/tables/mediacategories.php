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

class MediamanagerTableMediaCategories extends DSCTable 
{ 
	function MediamanagerTableMediaCategories ( &$db ) 
	{
		$tbl_key 	= 'mediacategory_id';
		$tbl_suffix = 'mediacategories';
		$name 		= 'mediamanager';
		
		$this->set( '_tbl_key', $tbl_key );
		$this->set( '_suffix', $tbl_suffix );
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check()
	{
		if (empty($this->category_id))
		{
			$this->setError( JText::_( "Category Required" ) );
		}
		
		if (empty($this->media_id))
		{
			$this->setError( JText::_( "Media Required" ) );
		}
		
		$db = $this->getDBO();
		$db->setQuery( "SELECT mediacategory_id FROM #__mediamanager_mediacategories WHERE category_id = '$this->category_id' AND media_id = '$this->media_id' LIMIT 1;" );
        if ($db->loadResult()) {
            $this->setError( JText::_( "Media-Category Association Already Exists" ) );
        }
        		
		return parent::check();
	}
	
	/**
	 *
	 * @param $oid
	 * @return unknown_type
	 */
	function delete( $oid=null )
	{
		$dispatcher = JDispatcher::getInstance();
		$before = $dispatcher->trigger( 'onBeforeDelete'.$this->get('_suffix'), array( $this, $oid ) );
		if (in_array(false, $before, true))
		{
			return false;
		}

		if (!empty($oid)) {
		    $this->load( $oid );
		}

		$db = $this->getDBO();
		$db->setQuery( "DELETE FROM #__mediamanager_mediacategories WHERE category_id = '$this->category_id' AND media_id = '$this->media_id';" );
		if ( $return = $db->query() )
		{
			$dispatcher = JDispatcher::getInstance();
			$dispatcher->trigger( 'onAfterDelete'.$this->get('_suffix'), array( $this, $oid ) );
		}
		return $return;
	}
}
	