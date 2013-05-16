<?php
/**
 * @version	1.5
 * @package	Locator
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die('Restricted access');

class LocatorViewBase extends DSCViewAdmin
{
	function display($tpl=null)
	{
		JHTML::_('stylesheet', 'admin.css', 'media/com_locator/css/');
		
		parent::display($tpl);
	}
}