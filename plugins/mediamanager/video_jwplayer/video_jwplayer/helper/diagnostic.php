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

class MediaManagerHelperDiagnosticVideoJwplayer extends DSCHelperDiagnostics
{
	/**
	 * Performs basic checks on your installation to ensure it is OK
	 * @return unknown_type
	 */
	function checkInstallation( )
	{
		if ( !$this->checkTableExistsVideoJwplayer( ) )
		{
			return $this->redirect( JText::_( 'DIAGNOSTIC checkTableExistsVideoJwplayer FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
	}
	
	/**
	 * Confirms existence of the DB table 
	 * 
	 */
	function checkTableExistsVideoJwplayer( )
	{
		// if this has already been done, don't repeat
		if ( MediaManager::getInstance( )->get( 'checkTableExistsVideoJwplayer', '0' ) )
		{
			return true;
		}
		
		$table = '#__mediamanager_video_jwplayer';
		$definition = '
            CREATE TABLE IF NOT EXISTS `#__mediamanager_video_jwplayer` (
              `videojwplayer_id` int(11) NOT NULL AUTO_INCREMENT,
              `media_id` int(11) NOT NULL,
              `mediafile_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `caption` text,
              `url` varchar(255) NOT NULL,
              `url_target` tinyint(1) NOT NULL,
              `enabled` tinyint(1) NOT NULL,
              `ordering` int(11) NOT NULL,
              PRIMARY KEY (`videojwplayer_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
        ';
		
		if ( $this->createTable( $table, $definition ) )
		{
			// Update config to say this has been done already
			JTable::addIncludePath( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_mediamanager' . DS . 'tables' );
			$config = JTable::getInstance( 'Config', 'MediaManagerTable' );
			$config->load( array( 'config_name' => 'checkTableExistsVideoJwplayer' ) );
			$config->config_name = 'checkTableExistsVideoJwplayer';
			$config->value = '1';
			$config->save( );
			return true;
		}
		return false;
	}
}
