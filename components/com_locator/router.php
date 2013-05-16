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

if ( !class_exists('Locator') ) {
    JLoader::register( "Locator", JPATH_ADMINISTRATOR.DS."components".DS."com_locator".DS."defines.php" );
}

Locator::load( "LocatorHelperRoute", 'helpers.route' );

/**
 * Build the route
 * Is just a wrapper for LocatorHelperRoute::build()
 * 
 * @param unknown_type $query
 * @return unknown_type
 */
function LocatorBuildRoute(&$query)
{
    return LocatorHelperRoute::build($query);
}

/**
 * Parse the url segments
 * Is just a wrapper for LocatorHelperRoute::parse()
 * 
 * @param unknown_type $segments
 * @return unknown_type
 */
function LocatorParseRoute($segments)
{
    return LocatorHelperRoute::parse($segments);
}