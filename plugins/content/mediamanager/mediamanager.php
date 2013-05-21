<?php
/**
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
if (JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'defines.php')) 
{
    if ( !class_exists('MediaManager') ) { 
        JLoader::register( "MediaManager", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );
    }
	
    MediaManager::load( 'MediaManagerPluginBase', 'library.plugin.base' );

    class plgContentMediaManager extends MediaManagerPluginBase
    {
    	/**
    	 * @var $_element  string  Should always correspond with the plugin's filename, 
    	 *                         forcing it to be unique 
    	 */
        var $_element    = 'mediamanager';
        
    	public function __construct(& $subject, $config) 
    	{
    		parent::__construct($subject, $config);
    		$this->loadLanguage( '', JPATH_ADMINISTRATOR );
    		$this->loadLanguage('com_mediamanager');
    	}
    	
        /**
         * Joomla < 1.6 prepare content function 
         * 
         * Enter description here ...
         * @param unknown_type $row
         * @param unknown_type $params
         * @param unknown_type $page
         */
    	public function onPrepareContent( &$row, &$params, $page=0 )
    	{
    	    $context = 'com_content.article';
    	    return $this->doContentPrepare($context, $row, $params, $page);
    	}

    	/**
    	 * Joomla 1.6+ prepare content function
    	 * 
    	 * @param unknown_type $context
    	 * @param unknown_type $article
    	 * @param unknown_type $params
    	 * @param unknown_type $page
    	 */
    	public function onContentPrepare($context, &$article, &$params, $page = 0)
    	{
    	    return $this->doContentPrepare($context, $article, $params, $page);
    	}
    	
    	/**
    	* Search for the tag and replace it with the media view {mediamanager}
    	*
    	* @param $article
    	* @param $params
    	* @param $limitstart
    	*/    	
    	private function doContentPrepare($context, &$row, &$params, $page = 0)
    	{
    	    if( !$this->isInstalled() )
    	    return true;
    	     
    	    // simple performance check to determine whether bot should process further
    	    if ( JString::strpos( $row->text, 'mediamanager' ) === false ) {
    	        return true;
    	    }
    	    
    	    // Get plugin info
    	    $plugin = JPluginHelper::getPlugin('content', 'mediamanager');
    	    
    	    // expression to search for
    	    $regex = '/{mediamanager\s*.*?}/i';
    	    
    	    $pluginParams = new DSCParameter( $plugin->params );
    	    
    	    // check whether plugin has been unpublished
    	    if ( !$pluginParams->get( 'enabled', 1 ) ) {
    	        $row->text = preg_replace( $regex, '', $row->text );
    	        return true;
    	    }
    	    
    	    // find all instances of plugin and put in $matches
    	    preg_match_all( $regex, $row->text, $matches );
    	    
    	    // Number of plugin instances
    	    $count = count( $matches[0] );
    	    
    	    // plugin only processes if there are any instances of the plugin in the text
    	    if ( $count ) {
    	        foreach($matches as $match)
    	        {
    	            $this->processTags( $row, $matches, $count, $regex );
    	        }
    	    }    	    
    	}
    	
     	/**
         * Checks the extension is installed
         * 
         * @return boolean
         */
        private function isInstalled()
        {
            $success = false;
            
            jimport('joomla.filesystem.file');
            if (JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'defines.php')) 
            {
                $success = true;
                // Check the registry to see if our MediaManager class has been overridden
                if ( !class_exists('MediaManager') ) 
                    JLoader::register( "MediaManager", JPATH_ADMINISTRATOR.DS."components".DS."com_mediamanager".DS."defines.php" );
            }
            return $success;
        }
        
        /**
         * Processes the various mediamanager plugin instances
         * 
         * @param $row
         * @param $matches
         * @param $count
         * @param $regex
         * @return unknown_type
         */
        private function processTags( $row, $matches, $count, $regex )
        {
            for ( $i=0; $i < $count; $i++ )
            {
                $load = str_replace( 'mediamanager', '', $matches[0][$i] );
                $load = str_replace( '{', '', $load );
                $load = str_replace( '}', '', $load );
                $load = trim( $load );
        
                $item    = $this->processTag( $load );
                $row->text  = str_replace($matches[0][$i], $item, $row->text );
            }
        
            // removes tags without matching
            $row->text = preg_replace( $regex, '', $row->text );
        }
        
        /**
         * Shows a single media item based on params (if present)
         * @param $load
         * @return unknown_type
         */
        private function processTag( $load )
        {
            $inline_params = explode(" ", $load);
            
            $params = $this->get('params');
            $params = $params->toArray();
            
            $params['attributes'] = array();
            // Merge plugin parameters with tag parameters, overwriting wherever necessary
            foreach( $inline_params as $p )
            {
                $data = explode("=", $p);
                $k = $data[0];
                $v = $data[1];
                
                $params[$k] = $v;
            }
            
            // No id set, return
            if( !array_key_exists('id', $params) )
            {
                return;
            }
               
            MediaManager::load('MediaManagerModelMedia', 'models.media');
            $model = JModel::getInstance('Media', 'MediaManagerModel');
            $model->setId( (int) $params['id'] );
            $row = $model->getItem();
                    
            if (empty($row->media_enabled))
            {
                return;
            }
            
            return $this->view( $row, $params );
           
        }

        /**
         * 
         * Enter description here ...
         * @param unknown_type $name
         * @return unknown_type
         */
        private function getModel( $name )
        {
            JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
            $model = JModel::getInstance( $name, 'MediaManagerModel' );
            return $model;
        }
        
        /**
         * 
         * Enter description here ...
         * @param $row
         * @param $params
         * @return unknown_type
         */
        private function view( $media_item , $params=array() )
        {
            // if empty media_item->media_id or media_item->media_type, fail
            if (empty($media_item->media_id) || empty($media_item->media_type))
            {
                JError::raiseNotice( '', 'Invalid Media' );
                return;
            }
            
            $hmodel = $this->getModel( 'handlers' );
            $handler = $hmodel->getTable();
            $handler->load( array( 'element'=>$media_item->media_type ) );
            
            $keyName = $handler->getKeyName();
            if (empty($handler->$keyName))
            {
                JError::raiseNotice( '', 'Invalid Media Type' );
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
            $dispatcher = JDispatcher::getInstance();
            $results = $dispatcher->trigger( 'onDisplayMediaItem', array( $handler, $media_item ) );
            for ($i=0; $i<count($results); $i++) 
            {
                $html .= $results[$i];
            }
            
            $vars = new JObject();
            $vars->row = $media_item;
            $vars->params = $params;
            $vars->handler_html = $html;
            
            return $this->_getLayout( 'view', $vars );
            
        }
        
        /**
        * (non-PHPdoc)
        * @see mediamanager/mediamanager/admin/library/plugins/MediaManagerPluginBase::_getLayout()
        */
        protected function _getLayout($layout, $vars = false, $plugin = '', $group = 'content')
        {
            return parent::_getLayout($layout, $vars, $plugin, $group);
        }
    }
}