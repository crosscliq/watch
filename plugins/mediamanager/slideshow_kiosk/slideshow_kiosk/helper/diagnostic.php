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

class MediaManagerHelperDiagnosticSlideshowKiosk extends DSCHelperDiagnostics
{
	/**
	 * Performs basic checks on your installation to ensure it is OK
	 * @return unknown_type
	 */
	function checkInstallation( )
	{
		if ( !$this->checkTableExistsSlideshowKiosk( ) )
		{
			return $this->redirect( JText::_( 'DIAGNOSTIC checkTableExistsSlideshowKiosk FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
		
		if ( !$this->checkPublicationFieldsExistSlideshowKiosk( ) )
		{
		    return $this->redirect( JText::_( 'DIAGNOSTIC checkPublicationFieldsExistSlideshowKiosk FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
	}
	
	/**
	 * Confirms existence of the DB table 
	 * 
	 */
	function checkTableExistsSlideshowKiosk( )
	{
		// if this has already been done, don't repeat
		if ( MediaManager::getInstance( )->get( 'checkTableExistsSlideshowKiosk', '0' ) )
		{
			return true;
		}
		
		$table = '#__mediamanager_slideshow_default';
		$definition = '
            CREATE TABLE IF NOT EXISTS `#__mediamanager_slideshow_default` (
              `slideshowdefault_id` int(11) NOT NULL AUTO_INCREMENT,
              `media_id` int(11) NOT NULL,
              `mediafile_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `caption` text,
              `url` varchar(255) NOT NULL,
              `url_target` tinyint(1) NOT NULL,
              `enabled` tinyint(1) NOT NULL,
              `ordering` int(11) NOT NULL,
              `publish_up` datetime NOT NULL,
              `publish_down` datetime NOT NULL,
              PRIMARY KEY (`slideshowdefault_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
        ';
		
		if ( $this->createTable( $table, $definition ) )
		{
			// Update config to say this has been done already
			JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
			$config = JTable::getInstance( 'Config', 'MediaManagerTable' );
			$config->load( array( 'config_name' => 'checkTableExistsSlideshowKiosk' ) );
			$config->config_name = 'checkTableExistsSlideshowKiosk';
			$config->value = '1';
			$config->save( );
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * Checks that certain fields exist
	 * 
	 * @return boolean
	 */
	function checkPublicationFieldsExistSlideshowKiosk( )
	{
	    // if this has already been done, don't repeat
	    if ( MediaManager::getInstance( )->get( 'checkPublicationFieldsExistSlideshowKiosk', '0' ) )
	    {
	        return true;
	    }
	
	    $table = '#__mediamanager_slideshow_default';
	    $fields = array();
	    $definitions = array();
	    
	    $fields[] = "publish_up";
	    $definitions["publish_up"] = "datetime NOT NULL";

	    $fields[] = "publish_down";
	    $definitions["publish_down"] = "datetime NOT NULL";
	    
	    if ( $this->insertTableFields($table, $fields, $definitions) )
	    {
	        // Update config to say this has been done already
	        JTable::addIncludePath( JPATH_ADMINISTRATOR .'/components/com_mediamanager/tables' );
	        $config = JTable::getInstance( 'Config', 'MediaManagerTable' );
	        $config->load( array( 'config_name' => 'checkPublicationFieldsExistSlideshowKiosk' ) );
	        $config->config_name = 'checkPublicationFieldsExistSlideshowKiosk';
	        $config->value = '1';
	        $config->save( );
	        return true;
	    }
	    return false;
	}
}
