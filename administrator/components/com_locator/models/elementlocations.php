<?php
/**
 * @version 1.5
 * @package MediaManager
 * @media  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Locator::load( 'LocatorModelItems', 'models.items' );

class MediaManagerModelElementMedia extends DSCModelElement
{
    var $title_key = 'media_title';
    var $select_title_constant = 'COM_MEDIAMANAGER_SELECT_MEDIA';
    var $select_constant = 'COM_MEDIAMANAGER_SELECT';
    var $clear_constant = 'COM_MEDIAMANAGER_CLEAR_SELECTION';

    public function getTable($name='Media', $prefix='MediamanagerTable', $options = array())
    {
        JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
        return parent::getTable($name, $prefix, $options);
    }
}
?>
