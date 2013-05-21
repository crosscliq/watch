<?php
/**
 * @version	1.5
 * @package	Locator
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
 
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class LocatorTableItems extends DSCTable 
{
	public function LocatorTableItems( &$db ) 
	{
		$tbl_key 	= 'item_id';
		$tbl_suffix = 'items';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "locator";
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	
    
}