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

class MediaManagerHelperDiagnosticSlideshowPikachoose extends DSCHelperDiagnostics
{
	/**
	 * Performs basic checks on your installation to ensure it is OK
	 * @return unknown_type
	 */
	function checkInstallation( )
	{
		if ( !$this->checkTableExistsSlideshowPikachoose( ) )
		{
			return $this->redirect( JText::_( 'DIAGNOSTIC checkTableExistsSlideshowPikachoose FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
		
		if ( !$this->checkPublicationFieldsExistSlideshowPikachoose( ) )
		{
		    return $this->redirect( JText::_( 'DIAGNOSTIC checkPublicationFieldsExistSlideshowPikachoose FAILED' ) . ' :: ' . $this->getError( ), 'error' );
		}
	}
	
	/**
	 * Confirms existence of the DB table 
	 * 
	 */
	function checkTableExistsSlideshowPikachoose( )
	{
		// if this has already been done, don't repeat
		if ( MediaManager::getInstance( )->get( 'checkTableExistsSlideshowPikachoose', '0' ) )
		{
			return true;
		}
		
		$table = '#__mediamanager_slideshow_pikachoose';
		$definition = '
            CREATE TABLE IF NOT EXISTS `#__mediamanager_slideshow_pikachoose` (
              `slideshowpikachoose_id` int(11) NOT NULL AUTO_INCREMENT,
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
              PRIMARY KEY (`slideshowpikachoose_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
        ';
		
		if ( $this->createTable( $table, $definition ) )
		{
			// Update config to say this has been done already
			JTable::addIncludePath( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_mediamanager' . DS . 'tables' );
			$config = JTable::getInstance( 'Config', 'MediaManagerTable' );
			$config->load( array( 'config_name' => 'checkTableExistsSlideshowPikachoose' ) );
			$config->config_name = 'checkTableExistsSlideshowPikachoose';
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
	function checkPublicationFieldsExistSlideshowPikachoose( )
	{
	    // if this has already been done, don't repeat
	    if ( MediaManager::getInstance( )->get( 'checkPublicationFieldsExistSlideshowPikachoose', '0' ) )
	    {
	        return true;
	    }
	
	    $table = '#__mediamanager_slideshow_pikachoose';
	    $fields = array();
	    $definitions = array();
	    
	    $fields[] = "publish_up";
	    $definitions["publish_up"] = "datetime NOT NULL";

	    $fields[] = "publish_down";
	    $definitions["publish_down"] = "datetime NOT NULL";
	    
	    if ( $this->insertTableFields($table, $fields, $definitions) )
	    {
	        // Update config to say this has been done already
	        JTable::addIncludePath( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_mediamanager' . DS . 'tables' );
	        $config = JTable::getInstance( 'Config', 'MediaManagerTable' );
	        $config->load( array( 'config_name' => 'checkPublicationFieldsExistSlideshowPikachoose' ) );
	        $config->config_name = 'checkPublicationFieldsExistSlideshowPikachoose';
	        $config->value = '1';
	        $config->save( );
	        return true;
	    }
	    return false;
	}
}
