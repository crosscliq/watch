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

class MediamanagerHelperRoute extends DSCHelperRoute 
{
    static $itemids = null;
    
    public static function getItems( $option='com_mediamanager' )
    {
        return parent::getItems($option);        
    }
    
    /**
     * Build the route
     *
     * @param   array   An array of URL arguments
     * @return  array   The URL arguments to use to assemble the URL
     */
    public static function build( &$query )
    {
        $segments = array();
    
        // get a menu item based on the Itemid or the currently active item
        $menu = JFactory::getApplication()->getMenu();
    
        if (empty($query['Itemid']))
        {
            $item = $menu->getActive();
            $menuItemGiven = false;
        }
        else
        {
            $item = $menu->getItem( $query['Itemid'] );
            $menuItemGiven = true;
        }
    
        $menuView = (empty($item->query['view'])) ? null : $item->query['view'];
        $menuTask = (empty($item->query['task'])) ? null : $item->query['task'];
        $menuId = (empty($item->query['id'])) ? null : $item->query['id'];
        $menuIdLibrary = (empty($item->query['library_id'])) ? null : $item->query['library_id'];
    
        // if the menu item and the query match...
        if ($menuView == @$query['view'] &&
                $menuTask == @$query['task'] &&
                $menuId == @$query['id']
        ) {
            // unset all variables and use the menu item's alias set by user
            unset ($query['view']);
            unset ($query['task']);
            unset ($query['id']);
        }
        
        // if the menu item and the query match...
        if ($menuView == @$query['view'] &&
                $menuTask == @$query['task'] &&
                $menuIdLibrary == @$query['library_id']
        ) {
            // unset all variables and use the menu item's alias set by user
            unset ($query['view']);
            unset ($query['task']);
            unset ($query['library_id']);
        }
    
        // otherwise, create the sef url from the query
        if ( !empty ($query['view'])) {
            $view = $query['view'];
            $segments[] = $view;
            unset ($query['view']);
        }
    
        if ( !empty ($query['task'])) {
            $task = $query['task'];
            $segments[] = $task;
            unset ($query['task']);
        }
    
        if ( !empty ($query['id'])) {
            $id = $query['id'];
            $segments[] = $id;
            unset ($query['id']);
        }
    
        return $segments;
    }
    
    /**
     * Parses the segments of a URL
     *
     * @param   array   The segments of the URL to parse
     * @return  array   The URL attributes
     */
    public static function parse( $segments )
    {
        //echo "segments:<br /><pre>";
        //print_r($segments);
        //echo "</pre>";
    
        $vars = array();
        $count = count($segments);
    
        $vars['view'] = $segments[0];
        switch ($segments[0])
        {
            default:
                if ($count == '2')
                {
                    switch($segments[0]) {
                        case "item":
                        case "media":
                            if (is_numeric($segments[1])) {
                                $vars['id'] = $segments[1];
                            } else {
                                $vars['task'] = $segments[1];
                            }
                            break;
                        default:
                            $vars['task'] = $segments[1];
                            break;
                    }
                }
    
                if ($count == '3')
                {
                    $vars['task'] = $segments[1];
                    $vars['id'] = $segments[2];
                }
    
                break;
        }
    
    
        //echo "vars:<br /><pre>";
        //print_r($vars);
        //echo "</pre>";
    
        return $vars;
    }
}