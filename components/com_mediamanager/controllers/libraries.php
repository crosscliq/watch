<?php
/**
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class MediaManagerControllerLibraries extends MediaManagerController
{
	function __construct( )
	{
		parent::__construct( );
		$this->set( 'suffix', 'libraries' );
	}
	
	function getNamespace()
	{
		$app = JFactory::getApplication();
		$ns = $app->getName().'::'.'com.mediamanager.state';
		return $ns;
	}

	/**
	 * Sets the model's default state based on values in the request
	 *
	 * @return array()
	 */
	function _setModelState( &$model=null )
	{
		$state = parent::_setModelState( );
		$app = JFactory::getApplication( );
		if (empty($model)) {
		    $model = $this->getModel( $this->get( 'suffix' ) ); 
		}		
		$ns = $this->getNamespace( );
        
	    if (empty($this->helper)) { $this->helper = new MediamanagerHelperMedia(); }
	    $state = array_merge( $state, $this->helper->getState() );
	    
		foreach ( @$state as $key => $value )
		{
			$model->setState( $key, $value );
		}
		return $state;
	}
	
	private function setMediaModelState( $model=null )
	{
	    $state = parent::_setModelState( $model );
	    $app = JFactory::getApplication();
	    if (empty($model)) {
	        $model = $this->getModel( 'media' );
	    }
	    $ns = $this->getNamespace();
	    
	    if (empty($this->helper)) { $this->helper = new MediamanagerHelperMedia(); }
	    $state = array_merge( $state, $this->helper->getState() );	    
	    foreach ( @$state as $key => $value )
	    {
	        $model->setState( $key, $value );
	    }
	    return $state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MediaManagerController::view()
	 */
	function view($cachable=false, $urlparams = false)
	{
		$view = $this->getView( 'libraries', 'html' );
		$view->set( '_doTask', true );
		$view->set( 'hidemenu', true );

		$state = $this->_setModelState();
		//$state = $this->helper->getState();

		// load the library item
		$model = $this->getModel( 'libraries' );
		$model->setId( $state['library_id'] );
		$library_item = $model->getItem( $state['library_id'], true );
	
		// the library item determines which filters should be applied to the media model
		$media_model = $this->getModel( 'media' );
		$this->_setModelState( $media_model );
		
		// TODO let the library definition set defaults, but add sorting capabilities to the front-end so user can specify
		$media_model->setState('order', 'tbl.media_title');
		$media_model->setState('direction', 'ASC');
		
		$items = $media_model->getList();
		$media_model->setState('pagination.base_url', JRoute::_( "index.php?option=com_mediamanager&view=libraries&task=view" ) );
		$pagination = $media_model->getPagination();
		
		if ( !empty( $library_item->default_media_id ) )
		{
		    $media_id = $library_item->default_media_id;
		    
		    $this->getItem( $media_id );
            
		    $media_item = $this->media_item;
		    $handler = $this->handler;
		    $html = trim( $this->html );
		    
		    $view->assign( 'handler', $handler );
		    $view->assign( 'handler_html', $html );
		    $view->assign( 'featured_item', $media_item );
		}
		
		/*
		$document = JFactory::getDocument();
		$page_title = $media_item->media_title;
		$page_title .= " | " . ucwords($media_item->media_group);
		$document->setTitle( strip_tags( $page_title ) );
		$document->setDescription( strip_tags( htmlspecialchars_decode( $media_item->media_description ) ) );
		*/
		
		$view->setModel( $model, true );
		$view->setModel( $media_model );
		$view->no_state = true;
		$view->no_pagination = true;
		$view->no_items = true;
		
		$view->assign( 'items', $items );
		$view->assign( 'pagination', $pagination );
		//$view->set( 'categories', $categories );
		$view->set( 'library', $library_item );
		
		$layout = 'view';
		if (!empty($library_item->library_layout)) 
		{
		    $layout = $library_item->library_layout;
		}
		JRequest::setVar( 'layout', $layout );
		
		parent::display( $cachable, $urlparams );
	}
	
	private function getItem( $media_id )
	{
	    $model = JModel::getInstance( 'Media', 'MediamanagerModel' );
	    $model->setId( $media_id );
	    $model->setState( 'get_categories', true );
	    $media_item = $model->getItem( $media_id );

	    $this->media_item = $model->getTable();
	    $this->handler = null;
	    $this->html = null;
	    
	    if (empty($media_item->media_id) || empty($media_item->media_type) || empty($media_item->media_enabled))
	    {
	        //JError::raiseNotice( '', 'MMCL1: Invalid Media' );
	        return;
	    }
	    
	    $hmodel = $this->getModel( 'handlers' );
	    $handler = $hmodel->getTable();
	    $handler->load( array( 'element'=>$media_item->media_type ) );
	    $key = $handler->getKeyName();
	    if (empty($handler->$key))
	    {
	        //JError::raiseNotice( '', 'MMCL: Invalid Media Type' );
	        return;
	    }
	    
	    if (empty($handler->published) && !empty($handler->id))
	    {
	        $handler->published = 1;
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
	     
	    $media_item->categories = array();
	    foreach ($media_item->mediacategories as $mc)
	    {
	        if (empty($media_item->categories[$mc->categorytype_id]))
	        {
	            $media_item->categories[$mc->categorytype_id] = array();
	        }
	        $media_item->categories[$mc->categorytype_id][] = $mc;
	    }
	    
	    $this->media_item = $media_item;
	    $this->handler = $handler;
	    $this->html = $html;
	    
	    return;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return return_type
	 */
	function filtercategories()
	{	
	    $msg = '';
		$this->_setModelState();
		$model = $this->getModel( $this->get( 'suffix' ) );
	    $state = $model->getState();
	    
		// get categories for filtering
		$elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );
		
		$vars = new JObject();
		MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
		$helper = new MediaManagerHelperBase();
		$values = $helper->elementsToArray( $elements );
		$item_id = $values['Itemid'];

		$categories = $values['categories'];
		$secondary_category = @$values['_checked']['secondary_category'];
		
		$media_model = $this->getModel( 'media' );
		
		$app = JFactory::getApplication();
		$ns = $this->getNamespace();

		$order = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.date_added', 'cmd');
		$media_model->setState( 'order', $order );
		$dir = 'DESC';
		if ($order == 'tbl.media_title') { $dir = 'ASC'; }
		$media_model->setState( 'direction', $dir );
		$media_model->setState( 'filter_enabled', '1' );
		$media_model->setState( 'limit', 8);
        $media_model->setState( 'filter_secondary_category', $secondary_category );
        
        $library_id = JRequest::getInt('id');
        $base_url = "index.php?option=com_mediamanager&view=libraries&task=view&id=" . $library_id . "&Itemid=" . $item_id . "&reset=0";
        $media_model->setState( 'pagination.base_url', $base_url );
        
		JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
		$model->setId( JRequest::getInt('id') );
		$library_item = $model->getItem();
		
		$lcmodel = JModel::getInstance( 'LibraryCategories', 'MediaManagerModel' );
		$lcmodel->setState('filter_library', JRequest::getInt('id') );
		$lcategories = $lcmodel->getList();
		$lcats = MediaManagerHelperBase::getColumn( $lcategories, 'category_id' );
		$media_model->setState( 'filter_categories', $lcats );

        MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
        $helper = MediaManagerHelperBase::getInstance( 'media' );
        $hstate = $helper->getState();
		if (!empty($hstate['tag_id']))
		{

		}
		
		$query = $media_model->getQuery();
		
		$where = array();
		$ctmodel = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
		$ctmodel->setState('get_categories', true);
        $items = $ctmodel->getList(false);
        foreach ($items as $ct)
        {
            $ct_cats = MediaManagerHelperBase::getColumn( $ct->categories, 'category_id' );
            // if no filters in this group are applied, then all of them are applied if they're part of the library definition
            if ($categories = array_intersect($ct_cats, $values['categories']))
            {
                $where[] = "(SELECT COUNT(*) FROM jos_mediamanager_mediacategories AS mediacats WHERE tbl.media_id = mediacats.media_id AND mediacats.category_id IN ('" . implode( "', '", $categories) . "') )";                        
            }
        }

        if (!empty($where))
        {
            $query->where( '(' . implode( ' AND ', $where ) . ')' );
        }
        $media_model->setQuery( $query );   
		
		
	    $list = $media_model->getList();
		MediaManager::load( 'MediaManagerHelperBase', 'helpers._base' );
        $helper = MediaManagerHelperBase::getInstance();
        foreach ($list as $item)
        {
            $item->media_description = $helper->truncateString( $item->media_description );
        }
        
        $pagination = $media_model->getPagination( );
        
		$view = $this->getView( 'libraries', 'html' );
		$view->set( '_controller', 'libraries' );
		$view->set( '_view', 'libraries' );
	    $view->setModel( $model, true );
		$view->set( '_doTask', true);
		$view->set( 'hidemenu', true);
		$view->assign( 'items', $list );
		$view->setLayout( 'view' );
		$view->assign( 'pagination', $pagination );
		$view->set( 'library', $library_item );
		$view->assign( 'item_id', $item_id );
		$view->assign( 'values', $values );
        $view->assign( 'order', $order );
        
		ob_start();
		$view->display();
		$html = ob_get_contents();
		ob_end_clean();
	    
		$module_html = $this->loadModule( JRequest::getVar('module_id') );
		// $html .= MediaManager::dump( (string) $media_model->getQuery() );
		// $html .= $msg;
        // $html .= MediaManager::dump( $hstate );  
		
		$return = array();
		$return['content'] = $html;
		$return['module'] = $module_html; 		
		echo ( json_encode( $return ) );
	}
	
}
