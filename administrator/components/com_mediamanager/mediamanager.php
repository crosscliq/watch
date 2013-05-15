<?php
/**
 * @package Mediamanager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

// Check the registry to see if our Mediamanager class has been overridden
if ( !class_exists('Mediamanager') ) 
    JLoader::register( "Mediamanager", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );

// before executing any tasks, check the integrity of the installation
Mediamanager::getClass( 'MediamanagerHelperDiagnostics', 'helpers.diagnostics' )->checkInstallation();

// Require the base controller
Mediamanager::load( 'MediamanagerController', 'controller' );

// Require specific controller if requested
$controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) );
if (!Mediamanager::load( 'MediamanagerController'.$controller, "controllers.$controller" ))
    $controller = '';

if (empty($controller))
{
    // redirect to default
	$default_controller = new MediamanagerController();
	$redirect = "index.php?option=com_mediamanager&view=" . $default_controller->default_view;
    $redirect = JRoute::_( $redirect, false );
    JFactory::getApplication()->redirect( $redirect );
}

DSC::loadBootstrap();

JHTML::_('stylesheet', 'common.css', 'media/dioscouri/css/');
JHTML::_('stylesheet', 'admin.css', 'media/com_mediamanager/css/');
JHTML::_('script','common.js','media/com_mediamanager/js/');

$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$js = "var com_mediamanager = {};\n";
$js.= "com_mediamanager.jbase = '".$uri->root()."';\n";
$doc->addScriptDeclaration($js);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_mediamanager/helpers';
DSCLoader::discover('MediamanagerHelper', $parentPath, true);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_mediamanager/library';
DSCLoader::discover('Mediamanager', $parentPath, true);

// load the plugins
JPluginHelper::importPlugin( 'mediamanager' );

// Create the controller
$classname = 'MediamanagerController'.$controller;
$controller = Mediamanager::getClass( $classname );
    
// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';  
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();
?>