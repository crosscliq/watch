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

 

class MediamanagerTableLibraryCategoryTypes extends DSCTable 
{ 
	function MediamanagerTableLibraryCategoryTypes ( &$db ) 
	{
		$tbl_key 	= 'librarycategorytype_id';
		$tbl_suffix = 'librarycategorytypes';
		$name 		= 'mediamanager';
		
		$this->set( '_tbl_key', $tbl_key );
		$this->set( '_suffix', $tbl_suffix );
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check()
	{
		if (empty($this->categorytype_id))
		{
			$this->setError( JText::_( "Category Type Required" ) );
			return false;
		}
		if (empty($this->library_id))
		{
			$this->setError( JText::_( "Library Required" ) );
			return false;
		}
		return true;
	}
}
	