<?php
/**
 * @version 1.5
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class MediaManagerControllerTags extends MediaManagerController
{
    /**
     * constructor
     */
    function __construct() 
    {
        parent::__construct();
        
        $this->set('suffix', 'tags');
    }

	/**
	 * (non-PHPdoc)
	 * @see mediamanager/mediamanager/site/MediaManagerController::_setModelState()
	 */
	function _setModelState( )
	{
		$state = parent::_setModelState( );
		$app = JFactory::getApplication( );
		$model = $this->getModel( $this->get( 'suffix' ) );
		$ns = $this->getNamespace( );
		
		$state = array( );
		
		foreach ( @$state as $key => $value )
		{
			$model->setState( $key, $value );
		}
		
		return $state;
	}
	
}