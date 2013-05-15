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

 

class MediamanagerTableCategoryTypes extends DSCTable 
{ 
	function MediamanagerTableCategoryTypes( &$db ) 
	{
		$tbl_key 	= 'categorytype_id';
		$tbl_suffix = 'categorytypes';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
}