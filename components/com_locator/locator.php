<?php
/**
 * @package Locator
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

// Check the registry to see if our Locator class has been overridden
if ( !class_exists('Locator') ) 
    JLoader::register( "Locator", JPATH_ADMINISTRATOR.DS."components".DS."com_locator".DS."defines.php" );

// before executing any tasks, check the integrity of the installation
Locator::getClass( 'LocatorHelperDiagnostics', 'helpers.diagnostics' )->checkInstallation();

// set the options array
$options = array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_locator' );

// Require the base controller
Locator::load( 'LocatorController', 'controller', $options );

// Require specific controller if requested
$controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) );
if (!Locator::load( 'LocatorController'.$controller, "controllers.$controller", $options ))
    $controller = '';

if (empty($controller))
{
    // redirect to default
    $default_controller = new LocatorController();
    $redirect = "index.php?option=com_locator&view=" . $default_controller->default_view;
    $redirect = JRoute::_( $redirect, false );
    JFactory::getApplication()->redirect( $redirect );
}

$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$js = "var com_locator = {};\n";
$js.= "com_locator.jbase = '".$uri->root()."';\n";
$doc->addScriptDeclaration($js);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_locator/helpers';
DSCLoader::discover('LocatorHelper', $parentPath, true);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_locator/library';
DSCLoader::discover('Locator', $parentPath, true);

// load the plugins
JPluginHelper::importPlugin( 'locator' );

// Create the controller
$classname = 'LocatorController'.$controller;
$controller = Locator::getClass( $classname );

// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';
    JRequest::setVar( 'layout', 'default' );
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();

?>