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

require_once ('items.php');
class LocatorControllerMap extends LocatorControllerItems
{
	function __construct() 
	{
		parent::__construct();
		$this->set('suffix', 'map');
	}

	
	function display($cachable=false, $urlparams = false )
	{	
		//$this->_setModelState();
		$view = $this->getView( $this->get( 'suffix' ), JFactory::getDocument( )->getType( ) );
		//$model = $this->getModel( $this->get( 'suffix' ) );
		$view->set( '_doTask', true );
		
		//$view->setModel( $model, true );
		$view->display();
	}

	function js($cachable=false, $urlparams = false )
	{	
		$view = $this->getView( $this->get( 'suffix' ), JFactory::getDocument( )->getType( ) );
	
		$view->set( '_doTask', true );
		$view->setLayout('js');
		$view->display();
	}

}