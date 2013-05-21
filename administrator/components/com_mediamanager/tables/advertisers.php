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

 

class MediamanagerTableAdvertisers extends DSCTable 
{ 
	function MediamanagerTableAdvertisers( &$db ) 
	{
		$tbl_key 	= 'advertiser_id';
		$tbl_suffix = 'advertisers';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "mediamanager";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
}