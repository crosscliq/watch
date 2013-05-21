<?php
/**
 * @version 1.5
 * @package Locator
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class LocatorModelBase extends DSCModel
{
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
    public function getTable($name='', $prefix='LocatorTable', $options = array())
    {
        DSCTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_locator/tables' );
        return parent::getTable($name, $prefix, $options);
    }

}