<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filter.filterinput' );
jimport( 'joomla.application.component.model' );
MediaManager::load( 'MediaManagerQuery', 'library.query' );

class MediaManagerModelBase extends DSCModel
{
    public $cache_enabled = false;
    public $cache_lifetime = 86400;
    
    /**
     * Method to get a table object, load it if necessary.
     *
     * @access  public
     * @param   string The table name. Optional.
     * @param   string The class prefix. Optional.
     * @param   array   Configuration array for model. Optional.
     * @return  object  The table
     * @since   1.5
     */
    function getTable($name='', $prefix='MediaManagerTable', $options = array())
    {
        JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'tables' );
        return parent::getTable($name, $prefix, $options);
    }

}