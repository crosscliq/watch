<?php
/**
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2009 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/*ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted Access' );
jimport( 'joomla.application.component.model' );

class modMediaManagerMediaHelper extends JObject
{
	/**
	 * Sets the modules params as a property of the object
	 * @param unknown_type $params
	 * @return unknown_type
	 */
	function __construct( $params )
	{
		$this->params = $params;
		//include model and table... moved to construct as called multiple times
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
	}
	/**
	 * Gets the various db information to sucessfully display item
	 * @return unknown_type
	 */
	function getItem( $id )
	{
		// Check the registry to see if our MediaManager class has been overridden
		if ( !class_exists( 'MediaManager' ) ) JLoader::register( "MediaManager", JPATH_ADMINISTRATOR . DS . "components" . DS . "com_mediamanager" . DS . "defines.php" );
		//load the config class
		MediaManager::load( 'MediaManagerConfig', 'defines' );
		
		//get the model 
		$model = JModel::getInstance( 'Media', 'MediaManagerModel' );
		
		$model->setId( ( int ) $id );
		$row = $model->getItem( );
		
		//double check that item is enabled
		if ( empty( $row->media_enabled ) )
		{
			return;
		}
		
		return $row;
	}
	/**
	 * Get the neccesary logic for the specific plugin ...
	 * @param unknown_type $item
	 * @return unknown_type
	 */
	function getPlugin( $media_item, $params = array( ) )
	{
		// if empty media_item->media_id or media_item->media_type, fail
		if ( empty( $media_item->media_id ) || empty( $media_item->media_type ) )
		{
			echo JText::_( 'Invalid Media Item' );
			return;
		}
		
        $hmodel = JModel::getInstance( 'Handlers', 'MediaManagerModel' );
        $handler = $hmodel->getTable();
        $handler->load( array( 'element'=>$media_item->media_type ) );
		
        $keyName = $handler->getKeyName();
        if (empty($handler->$keyName))
        {
            echo JText::_( 'Invalid Media Type' );
            return;
        }
		
        if ((empty($handler->published) && empty($handler->enabled)) && !empty($handler->$keyName))
        {
            if (isset($handler->published)) 
            {
                $handler->published = 1;
            }
            
            if (isset($handler->enabled))
            {
                $handler->enabled = 1;
            }
            
            if ($handler->store())
            {
                // do we need to redirect?
                $uri = JURI::getInstance();
                $redirect = $uri->toString();
                $redirect = JRoute::_( $redirect, false );
                $this->setRedirect( $redirect );
                return;
            }
        }
		
		$import = JPluginHelper::importPlugin( 'mediamanager', $handler->element );
		
		$html = '';
		$dispatcher = JDispatcher::getInstance( );
		$results = $dispatcher->trigger( 'onDisplayMediaItem', array( $handler, $media_item ) );
		for ( $i = 0; $i < count( $results ); $i++ )
		{
			$html .= $results[$i];
		}
		
		$vars = new JObject( );
		$vars->row = $media_item;
		$vars->params = $params;
		$vars->handler_html = $html;
		
		return $vars;
	}
}
?>