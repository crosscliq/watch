<?php
/**
 * @version	1.5
 * @package	Mediamanager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

MediaManager::load( 'MediaManagerModelBase', 'models._base' );

class MediamanagerModelDashboard extends MediaManagerModelBase 
{
    function getTable($name='Config', $prefix='MediaManagerTable', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }
}