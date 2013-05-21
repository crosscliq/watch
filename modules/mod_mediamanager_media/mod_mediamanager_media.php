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

$helper = new modMediaManagerMediaHelper( $params);
//get the media id supplied by user 
$media_id = $params->get( 'media_id' );

//lets get db information about media item
$item = $helper->getItem( $media_id );

//now we have the db info lets get the plugin stuff 
$vars = $helper->getPlugin( $item );

require ( JModuleHelper::getLayoutPath( 'mod_mediamanager_media' ) );
