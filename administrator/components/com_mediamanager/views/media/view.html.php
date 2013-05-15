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
defined('_JEXEC') or die('Restricted Access'); 

MediaManager::load('MediaManagerViewBase', 'views._base');

class MediaManagerViewMedia extends MediaManagerViewBase
{
    function getLayoutVars($tpl=null)
    {
        $layout = $this->getLayout();
        switch(strtolower($layout))
        {
            case "add":
                
              break;
            case "view":
                $this->_form($tpl);
              break;
            case "form":
                JRequest::setVar('hidemainmenu', '1');
                $this->_form($tpl);
              break;
            case "default":
            default:
                $this->_default($tpl);
              break;
        }
    }
    
    function _defaultToolbar()
    {
    	JToolBarHelper::publishList('media_enabled.enable');
    	JToolBarHelper::unpublishList('media_enabled.disable');
        parent::_defaultToolbar();
    }
    
    function _formToolbar($isNew=null)
    {
    	$bar = JToolBar::getInstance('toolbar');
    	parent::_formToolbar($isNew);
    	$model=$this->getModel();
    	$bar->appendButton( 'Popup', 'preview', 'Preview', JURI::root().'index.php?option=com_mediamanager&view=media&task=view&id='.$model->getId().'&tmpl=component', '1000', '450' );
    }
}