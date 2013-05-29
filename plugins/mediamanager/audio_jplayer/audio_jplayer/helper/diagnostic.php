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

class MediaManagerHelperDiagnosticAudioJplayer extends DSCHelperDiagnostics
{
	/**
	 * Performs basic checks on your installation to ensure it is OK
	 * @return unknown_type
	 */
	function checkInstallation( )
	{
		if ( !$this->checkTableExistsAudioJplayer( ) )
		{
			return $this->redirect( JText::_( 'DIAGNOSTIC checkTableExistsAudioJplayer FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
	}
	
	/**
	 * Confirms existence of the DB table 
	 * 
	 */
	function checkTableExistsAudioJplayer( )
	{
		// if this has already been done, don't repeat
		if ( MediaManager::getInstance( )->get( 'checkTableExistsAudioJplayer', '0' ) )
		{
			return true;
		}
		
		$table = '#__mediamanager_audio_jplayer';
		$definition = '
            CREATE TABLE IF NOT EXISTS `#__mediamanager_audio_jplayer` (
              `audiojplayer_id` int(11) NOT NULL AUTO_INCREMENT,
              `media_id` int(11) NOT NULL,
              `mediafile_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `caption` text,
              `url` varchar(255) NOT NULL,
              `url_target` tinyint(1) NOT NULL,
              `enabled` tinyint(1) NOT NULL,
              `ordering` int(11) NOT NULL,
              PRIMARY KEY (`audiojplayer_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
        ';
		
		if ( $this->createTable( $table, $definition ) )
		{
			// Update config to say this has been done already
			JTable::addIncludePath( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_mediamanager' . DS . 'tables' );
			$config = JTable::getInstance( 'Config', 'MediaManagerTable' );
			$config->load( array( 'config_name' => 'checkTableExistsAudioJplayer' ) );
			$config->config_name = 'checkTableExistsAudioJplayer';
			$config->value = '1';
			$config->save( );
			return true;
		}
		return false;
	}
}
