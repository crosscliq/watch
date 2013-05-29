<?php
/**
 * @version 1.5
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class MediaManagerPluginBase extends DSCPlugin
{
    protected function _getLayout($layout, $vars = false, $plugin = '', $group = 'mediamanager' )
    {
        return parent::_getLayout($layout, $vars, $plugin, $group);
    }
}