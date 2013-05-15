<?php
/**
 * @package    Mediamanager
 * @author     Dioscouri Design
 * @link     http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

MediaManager::load( 'MediaManagerViewBase', 'views._base' );

class MediamanagerViewDashboard extends MediaManagerViewBase
{
    /**
    * Displays text as the title of the page
    *
    * @param $text
    * @return unknown_type
    */
    public function displayTitle($text = '')
    {
        $layout = $this->getLayout();
        switch(strtolower($layout))
        {
            case "footer":
                break;
            case "default":
            default:
                $app = DSC::getApp();
                $title = $text ? JText::_($text) : JText::_(ucfirst(JRequest::getVar('view')));
                JToolBarHelper::title($title, $app->getName());
                break;
        }
    }
    
    /**
     * The default toolbar for a list
     * @return unknown_type
     */
    function _defaultToolbar()
    {
    }
}