<?php
/**
 * @package	Locator
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class LocatorControllerItems extends LocatorController
{
	function __construct() 
	{
		parent::__construct();
		$this->set('suffix', 'items');
	}
	
	function _setModelState()
    {
    	
		$state = array();   	
		$app = JFactory::getApplication();
		$model = $this->getModel( $this->get('suffix') );
    	$ns = $this->getNamespace();

    	$state['limit']  	= $app->getUserStateFromRequest('global.list.limit', 'lmt', 1000, 'int');
    	
		$state['limitstart'] = $app->getUserStateFromRequest($ns.'limitstart', 'limitstart', 0, 'int');
		$state['order']     = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.'.$model->getTable()->getKeyName(), 'cmd');
		$state['direction'] = $app->getUserStateFromRequest($ns.'.filter_direction', 'filter_direction', 'ASC', 'word');
		$state['filter']    = $app->getUserStateFromRequest($ns.'.filter', 'filter', '', 'string');
		$state['filter_enabled'] 	= $app->getUserStateFromRequest($ns.'filter_enabled', 'filter_enabled', '', '');
        $state['filter_id_from']    = $app->getUserStateFromRequest($ns.'filter_id_from', 'filter_id_from', '', '');
        $state['filter_id_to']      = $app->getUserStateFromRequest($ns.'filter_id_to', 'filter_id_to', '', '');
		$state['id']        = JRequest::getVar('id', JRequest::getVar('id', '', 'get', 'int'), 'post', 'int');
    	$state['filter_name']   = $app->getUserStateFromRequest($ns.'name', 'filter_name', '', '');
		$state['filter_enabled'] 	= $app->getUserStateFromRequest($ns.'enabled', 'filter_enabled', '1', 'INT');
		$state['lat'] 	= $app->getUserStateFromRequest($ns.'lat', 'lat', '', '');
		$state['lng'] 	= $app->getUserStateFromRequest($ns.'lng', 'lng', '', '');
		$state['filter_radius'] 	= $app->getUserStateFromRequest($ns.'radius', 'filter_radius', '1', '');
		$state['order'] 	= $app->getUserStateFromRequest($ns.'order', 'order', 'distance', '');
		

      	
    	foreach (@$state as $key=>$value)
		{
			$model->setState( $key, $value );	
		}
  		return $state;
    }

    
	
	function display($cachable=false, $urlparams = false )
	{	
		$this->_setModelState();
		$view = $this->getView( $this->get( 'suffix' ), JFactory::getDocument( )->getType( ) );
		$model = $this->getModel( $this->get( 'suffix' ) );
		$view->set( '_doTask', true );
		$view->setModel( $model, true );
		$tpl = JFactory::getDocument( )->getType( );
		$view->display($tpl);
	}

}
