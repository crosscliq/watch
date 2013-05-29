<?php
/**
 * @version	1.5
 * @package	Sample
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class MediamanagerControllerDashboard extends MediaManagerController 
{
	/**
	 * constructor
	 */
	function __construct() 
	{
		parent::__construct();
		
		$this->set('suffix', 'dashboard');
	}

	/*public function display($cachable=false, $urlparams = false)
	{
	    $model = $this->getModel( $this->get('suffix') );
	    $state = $model->getState();
	    $state->stats_interval = JRequest::getVar('stats_interval', 'last_thirty');
	    $model->setState('stats_interval', $state->stats_interval);

	    $cache = JFactory::getCache('com_tienda');
	    $cache->setCaching(true);
	    $cache->setLifeTime('900');
	    $phones = $cache->call(array($model, 'getPhonesChartData'), $state->stats_interval);
	    $ads = $cache->call(array($model, 'getAdDisplaysChartData'), $state->stats_interval);
	    $total = $cache->call(array($model, 'getSumChartData'), $phones);
	    $sum = $cache->call(array($model, 'getSumChartData'), $ads);
	    	    
        $interval = $model->getStatIntervalValues($state->stats_interval);

	    $view = $this->getView( $this->get('suffix'), 'html' );
	    $view->assign( 'phones', $phones );
	    $view->assign( 'ads', $ads );
        $view->assign( 'total', $total );
        $view->assign( 'sum', $sum );
        $view->assign( 'interval', $interval );        
                
	    parent::display($cachable, $urlparams);
	}*/
	
	
}

?>