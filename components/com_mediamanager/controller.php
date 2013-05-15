<?php
/**
 * @version	0.1
 * @package	Mediamanager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class MediamanagerController extends DSCControllerSite 
{
    /**
    * default view
    */
    public $default_view = 'dashboard';
    
	var $_models = array();
	var $message = "";
	var $messagetype = "";
	
	public function footer() {}
}

?>