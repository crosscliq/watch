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

class MediaManagerControllerMedia extends MediaManagerController
{
	function __construct() 
	{
		parent::__construct();
		$this->set('suffix', 'media');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see DSCController::display()
	 */
	function display($cachable=false, $urlparams = false)
	{
	    $app = JFactory::getApplication();
	    $request = JRequest::get('request');
	    
	    // load the media item
        $model = $this->getModel( 'media' );
        $id = $model->getId();
        $model->setId( $id );
        $model->setState( 'get_categories', true );
        $media_item = $model->getItem( false );
        
        if (empty($media_item->media_id) || empty($media_item->media_type) || empty($media_item->media_enabled))
        {
            JError::raiseNotice( '', 'D1: Invalid Media' );
            return;
        }
        
        $hmodel = $this->getModel( 'handlers' );
        $handler = $hmodel->getTable();
        $handler->load( array( 'element'=>$media_item->media_type ) );
        $key = $handler->getKeyName();
        if (empty($handler->$key))
        {
            JError::raiseNotice( '', 'D2: Invalid Media Type' );
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
        
        $view   = $this->getView( 'media', 'html' );
        $view->set( '_doTask', true);
        $view->set( 'hidemenu', true);
        $view->setModel( $model, true );
        $view->setModel( $hmodel );
        $view->set('handler', $handler);
        $view->set('handler_html', $html);

    	$ctmodel = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
        $ctitems = $ctmodel->getList(false);
        $view->assign('category_types', $ctitems);
        
        $related_items = $model->getRelated( $id );
        $view->assign('related_items', $related_items);

        $helper = new MediaManagerHelperBase();
        $helpermedia = new MediaManagerHelperMedia();
        $state = $helpermedia->getState();
        if (!empty($state['library_id'])) {
            $tag_url_base = "index.php?option=com_mediamanager&view=libraries&task=view&id=" . $state['library_id'] . "&reset=1&tag_id=";
        } else {
            $tag_url_base = "index.php?option=com_mediamanager&view=libraries&task=view&id=&reset=1&tag_id=";
        }
        $view->assign('tag_url_base', $tag_url_base);
        
        $library_category_types = array();
        $hstate = $helpermedia->getState();
		if (!empty($hstate['library_id']))
		{
		    $library = $this->getModel('libraries')->getTable();
		    $library->load( $hstate['library_id'] );
		    $view->assign( 'library', $library );
		    
    		$lctmodel = JModel::getInstance( 'LibraryCategoryTypes', 'MediaManagerModel' );
    		$lctmodel->setState( 'filter_library', $library->library_id );
            $lctitems = $lctmodel->getList();
            $library_category_types = $helper->getColumn( $lctitems, 'categorytype_id' );
		}
        $view->assign('library_category_types', $library_category_types);
        
        $document = JFactory::getDocument();
        $page_title = $media_item->media_title;
        $page_title .= " | " . ucwords($media_item->media_group);
        $document->setTitle( strip_tags( htmlspecialchars_decode( $page_title ) ) );
        $document->setDescription( strip_tags( htmlspecialchars_decode( $media_item->media_description ) ) );
        
        $document->addCustomTag( "<meta property='og:image' content='" . JURI::root() . $media_item->media_image . "' />" );
        
        // TODO Add support for this, but we need a helper function.  See https://developers.facebook.com/docs/opengraph/complextypes/
        //$document->addCustomTag( "<meta property='og:type' content='$media_item->media_group' />" );
        
        $model = JModel::getInstance( 'Media', 'MediamanagerModel' );
        $surrounding = $model->getSurrounding( $id );
        $view->assign('surrounding', $surrounding);
        
        
        JRequest::setVar( 'layout', 'default' );        
        parent::display($cachable, $urlparams);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see DSCController::view()
	 */
	function view()
	{
	    $this->display();
	}
}