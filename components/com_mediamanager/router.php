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

if ( !class_exists('Mediamanager') ) {
    JLoader::register( "Mediamanager", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );
}

Mediamanager::load( "MediamanagerHelperRoute", 'helpers.route' );

/**
 * Build the route
 * Is just a wrapper for MediamanagerHelperRoute::build()
 * 
 * @param unknown_type $query
 * @return unknown_type
 */
function MediamanagerBuildRoute(&$query)
{
    return MediamanagerHelperRoute::build($query);
}

/**
 * Parse the url segments
 * Is just a wrapper for MediamanagerHelperRoute::parse()
 * 
 * @param unknown_type $segments
 * @return unknown_type
 */
function MediamanagerParseRoute($segments)
{
    return MediamanagerHelperRoute::parse($segments);
}