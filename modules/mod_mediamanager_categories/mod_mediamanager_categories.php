<?php
/**
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2009 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/*ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted Access' );

// Check the registry to see if our MediaManager class has been overridden
if ( !class_exists( 'MediaManager' ) ) JLoader::register( "MediaManager", JPATH_ADMINISTRATOR . DS . "components" . DS . "com_mediamanager" . DS . "defines.php" );
require_once ( dirname( __FILE__ ) . DS . 'helper.php' );

MediaManager::load( 'MediaManagerSelect', 'library.select' );
$helper = new modMediaManagerCategoriesHelper( $params);
 
$state = $helper->getState();
$library_id = $state['library_id'] ? $state['library_id'] : JRequest::getInt('id'); // get this from the menu item?
$library = $helper->getItem( $library_id );
$primary_categories = $helper->getPrimaryCategories( $library_id );
$secondary_categories = $helper->getSecondaryCategories(); // $helper->getSecondaryCategories( );

$item_id = $params->get('item_id', JRequest::getInt('Itemid') );
$v = JRequest::getVar( 'v' );

$updating = JText::_( "Updating Search Results" );
$onclick_primary = "mediamanagerUpdateCategories( 'mediamanager-content', document.multimedia_filters, '$library_id', '$module->id', 'event-filter', '$updating', true );";
$onclick_secondary = $onclick_primary;


require ( JModuleHelper::getLayoutPath( 'mod_mediamanager_categories' ) );
