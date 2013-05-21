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

MediaManager::load( 'MediaManagerModelLibraries', 'models.libraries' );

class MediaManagerModelElementLibrary extends DSCModelElement
{
    var $title_key = 'library_title';
    var $select_title_constant = 'COM_MEDIAMANAGER_SELECT_LIBRARY';
    var $select_constant = 'COM_MEDIAMANAGER_SELECT';
    var $clear_constant = 'COM_MEDIAMANAGER_CLEAR_SELECTION';

    public function getTable($name='Libraries', $prefix='MediamanagerTable', $options = array())
    {
        JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
        return parent::getTable($name, $prefix, $options);
    }	
}
?>
