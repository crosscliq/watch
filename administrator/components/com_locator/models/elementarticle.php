<?php
/**
 * @version 1.5
 * @package Locator
 * @user  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class LocatorModelElementArticle extends DSCModelElement
{
    var $title_key = 'title';
    var $select_title_constant = 'COM_LOCATOR_SELECT_ARTICLE';
    var $select_constant = 'COM_LOCATOR_SELECT';
    var $clear_constant = 'COM_LOCATOR_CLEAR_SELECTION';
    
    function getTable($name='', $prefix=null, $options = array())
    {
        $table = DSCTable::getInstance('Content', 'DSCTable');
        return $table;
    }
}
?>
