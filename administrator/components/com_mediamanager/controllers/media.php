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

class MediaManagerControllerMedia extends MediaManagerController
{
	
	/**
	 * constructor
	 */
	function __construct( )
	{
		parent::__construct( );
		$this->set( 'suffix', 'media' );
		//register extra tasks
		$this->registerTask( 'accessspecial', 'accessMenu' );
		$this->registerTask( 'accessregistered', 'accessMenu' );
		$this->registerTask( 'accesspublic', 'accessMenu' );
		
		$this->registerTask( 'media_enabled.enable', 'boolean' );
		$this->registerTask( 'media_enabled.disable', 'boolean' );
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
		$state['filter_media'] = $app->getUserStateFromRequest( $ns . 'filter_media', 'filter_media', '', '' );
		$state['filter_mediatype'] = $app->getUserStateFromRequest( $ns . 'filter_mediatype', 'filter_mediatype', '', '' );
		
		foreach ( @$state as $key => $value )
		{
			$model->setState( $key, $value );
		}
		
		return $state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see mediamanager/mediamanager/admin/MediaManagerController::edit()
	 */
	public function edit($cachable=false, $urlparams = false)
	{
		$model = $this->getModel( 'media' );
		$id = $model->getId( );
		$model->setId( $id );
		$model->setState('get_categories', true);
		$media_item = $model->getItem( $id, true );
		
		// are we creating a new media instance?
		$filter_handler = JRequest::getVar( 'handler' );
		if ( empty( $filter_handler ) && empty( $id ) )
		{
			// display list of handlers so admin can select one
			$hmodel = $this->getModel( 'handlers' );
			
			$groups = array( );
			$groups_list = $hmodel->getGroups( );
			foreach ( $groups_list as $group_item )
			{
				$group = new JObject( );
				$group->name = $group_item;
				
				$hmodel->setState( 'filter_type', $group_item );
				$group->handlers = $hmodel->getList( true );
				$groups[] = $group;
			}
			
			JRequest::setVar( 'layout', 'add' );
			
			$view = $this->getView( 'media', 'html' );
			$view->set( '_doTask', true );
			$view->set( 'hidemenu', false );
			$view->setModel( $hmodel );
			$view->set( 'groups', $groups );
			
			parent::display( $cachable, $urlparams );
			return;
		}
		
		$dispatcher = JDispatcher::getInstance( );
		
		// otherwise, display the form with the selected handler's options (form.php from the handler's folder)
		JRequest::setVar( 'layout', 'form' );
		
		$surrounding = array();
		
		// load the $handler
		if ( !empty( $id ) )
		{
			$filter_handler = $media_item->media_type;
			$media_group = $media_item->media_group;
			
			$new_model = JModel::getInstance('Media', 'MediamanagerModel');
			$this->_setModelState( $new_model );
			$surrounding = $new_model->getSurrounding( $new_model->getId() );
		}
		
		if (empty($media_group))
		{
		    $types = explode('_', $filter_handler);
		    $media_group = strtolower( $types[0] ); 
		}
		
		if ( empty( $id ) )
		{
			$media_item = $model->getTable( );
			$media_item->params = new DSCParameter( @$media_item->media_params);
		}
		
		$hmodel = $this->getModel( 'handlers' );
		$hmodel->setState( 'filter_element', $filter_handler );
		
		$html = '';
		$handler = $hmodel->getTable( );
		if ( $list = $hmodel->getList( ) )
		{
			$handler = $list[0];
			if ( empty( $handler->published ) && !empty( $handler->id ) )
			{
				$table = $hmodel->getTable( );
				$table->load( $handler->id );
				$table->published = 1;
				if ( $table->store( ) )
				{
					$uri = JURI::getInstance( );
					$redirect = $uri->toString( );
					$redirect = JRoute::_( $redirect, false );
					$this->setRedirect( $redirect );
					return;
				}
			}
			
			$import = JPluginHelper::importPlugin( 'mediamanager', $handler->element );
			
			$results = $dispatcher->trigger( 'onEditMedia', array( $handler, $media_item ) );
			for ( $i = 0; $i < count( $results ); $i++ )
			{
				$html .= $results[$i];
			}
		}
		
		$view = $this->getView( 'media', 'html' );
		$view->set( '_doTask', true );
		$view->set( 'hidemenu', false );
		$view->setModel( $model, true );
		$view->setModel( $hmodel );
		$view->set( 'handler', $handler );
		$view->set( 'handler_html', $html );
		$view->set( 'media_type', $filter_handler );
		$view->set( 'media_group', $media_group );
		
		$ctmodel = $this->getModel( 'categorytypes' );
		$ctmodel->setState('get_categories', true);
		$cts = $ctmodel->getList( false );
		$view->assign( 'categorytypes', $cts );
		
		$mediatags = array();
		$mtmodel = $this->getModel( 'MediaTags' );
		$mtmodel->setState('order', 'tag.tag_title');
		$mtmodel->setState('filter_media', $id);
		$mediatags = $mtmodel->getList( true );
		$view->assign( 'mediatags', $mediatags );

		$view->assign( 'surrounding', $surrounding );
		
		parent::display($cachable, $urlparams);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see mediamanager/mediamanager/admin/MediaManagerController::save()
	 */
	function save( )
	{
		parent::save( );

		$model 	= $this->getModel( $this->get('suffix') );
		$row = $model->getTable();
		$row->load( $model->getId() );

		$model->setState('get_categories', true);
		$item = $model->getItem( $row->media_id, true );
		$media_id = $model->getId();		
		
		MediaManager::load('MediaManagerHelperBase','helpers.base');
		$helper = new MediaManagerHelperBase();
		$mediacategories_ids = $helper->getColumn( $item->mediacategories, 'category_id' );

		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
		$mediacat = JTable::getInstance('MediaCategories', 'MediaManagerTable');
		$categories = JRequest::getVar( 'categories', array( ), 'post', 'array' );

		$row->media_categories = json_encode( $categories );
		$row->store();
		
		foreach ($item->mediacategories as $lc) {
		    if (!in_array($lc->category_id, $categories)) {
		        $mediacat->delete($lc->mediacategory_id);
		    }
		}
		
		foreach ($categories as $ct)
		{
		    if (!in_array($ct, $mediacategories_ids))
		    {
		        $mediacat = JTable::getInstance('MediaCategories', 'MediaManagerTable');
		        $mediacat->media_id = $media_id;
		        $mediacat->category_id = $ct;
		        $mediacat->store();
		    }
		}
		
		// do images
		// default
		$fieldname = 'new_thumbnail';
		$userfile = JRequest::getVar( $fieldname, '', 'files', 'array' );
		if ( !empty( $userfile['size'] ) )
		{
			$this->row = $row;
			if ( $upload = $this->addImage( $fieldname, $row->getThumbPath(), false ) )
			{
				$row->media_image = $upload->getPhysicalName( );
				$row->store( );
			}
			else
			{
				JFactory::getApplication( )->enqueueMessage( $upload->getError( ), 'notice' );
			}
		}
		
		$mediatags = JRequest::getVar( 'mediatags', array(), 'post', 'array' );
		$app = JFactory::getApplication();
		if (!empty($mediatags))
		{
		    foreach ($mediatags as $tag_title)
		    {
		        $mediatag = $this->getModel( 'MediaTags' )->getTable();
                $mediatag->media_id = $media_id;

                $tag = $this->getModel( 'Tags' )->getTable();
                $tag->tag_title = $tag_title;
                if ($tag->exists())
                {
                    // $app->enqueueMessage( JText::_( "Used this existing tag instead of creating new one" ) . ": " . $tag->tag_title );
                    $mediatag->tag_id = $tag->tag_id;
                    if (!$mediatag->save())
                    {
                        $app->enqueueMessage( $mediatag->getError() );
                    }
                }
                else
                {
                    // add new tag, then associate it
                    $tag->save();
                    $mediatag->tag_id = $tag->tag_id;
                    if (!$mediatag->save())
                    {
                        $app->enqueueMessage( $mediatag->getError() );
                    }
                }
		    }
		}
		
		$model = $this->getModel( 'mediafiles' );
		$model->clearCache();
		$mcmodel = $this->getModel( 'mediacategories' );
		$mcmodel->clearCache();
		$mtmodel = $this->getModel( 'mediatags' );
		$mtmodel->clearCache();
		
		return;
	}
	
	/**
	 * Adds an image to item
	 * @return unknown_type
	 */
	function addImage( $fieldname = 'new_image', $path = null, $do_thumb=true )
	{
		$row = $this->row;
		
		MediaManager::load( 'MediaManagerImage', 'library.image' );
		$upload = new MediaManagerImage( );
		
		// handle upload creates upload object properties
		$upload->handleUpload( $fieldname );
		
		// then save image to appropriate folder
		if ( empty( $path ) )
		{
			$path = $row->getImagePath( );
		}
		$upload->setDirectory( $path );
		
		// do upload!
		$upload->upload( );
		
		if ($do_thumb) 
		{
    		// TODO get thumb dimensions from somewhere in a config
    		$options = array( );
    		$options['width'] = 170;
    		$options['height'] = 120;
    		$options['thumb_path'] = $row->getThumbPath( );
    		
    		$copy = $upload;
    		if (!$copy->saveThumb( $copy ))
    		{
    		    JFactory::getApplication()->enqueueMessage( $copy->getError(), 'notice' );
    		}
		}
		
		return $upload;
	}
	
	/**
	 * Delete a product Image.
	 * Expected to be called via Ajax
	 */
	function deleteImage( )
	{
		MediaManager::load( "MediaManagerHelperMedia", 'helpers.media' );
		
		$media_id = JRequest::getInt( 'media_id', 0, 'request' );
		$image = JRequest::getVar( 'image', '', 'request' );
		$image = html_entity_decode( $image );
		
		// Find and delete the product image
		$helper = MediaManagerHelperBase::getInstance( 'Media', 'MediaManagerHelper' );
		$path = $helper->getGalleryPath( $media_id );
		
		$redirect = JRequest::getVar( 'return' ) ? base64_decode( JRequest::getVar( 'return' ) ) : "index.php?option=com_MediaManager&view=products&task=viewGallery&id={$product_id}&tmpl=component";
		$redirect = JRoute::_( $redirect, false );
		
		// Check if the data is ok
		if ( empty( $media_id ) || empty( $image ) )
		{
			$msg = JText::_( 'Input Data not Valid' );
			
			$redirect = "index.php?option=com_mediamanager&view=media";
			$redirect = JRoute::_( $redirect, false );
			
			$this->setRedirect( $redirect, $msg, 'notice' );
			return;
		}
		
		// Delete the image if it exists
		if ( JFile::exists( $path . $image ) )
		{
			$success = JFile::delete( $path . $image );
			
			// Try to delete the thumb, too
			if ( $success )
			{
				if ( JFile::exists( $path . 'thumbs' . DS . $image ) )
				{
					JFile::delete( $path . 'thumbs' . DS . $image );
					$msg = JText::_( 'Image Deleted' );
				}
				else
				{
					$msg = JText::_( 'Cannot Delete the Image Thumbnail: ' . $path . 'thumbs' . DS . $image );
				}
				
				// if it is the primary image, let's clear the product_image field in the db
				$model = $this->getModel( 'media' );
				$row = $model->getTable( );
				$row->load( $media_id );
				
				if ( $row->media_full_image == $image )
				{
					$row->media_full_image = '';
				}
				// TODO Save or store here?
				$row->store( );
			}
			else
			{
				$msg = JText::_( 'Cannot Delete the Image: ' . $path . $image );
			}
		}
		else
		{
			$msg = JText::_( 'Image does not Exist: ' . $path . $image );
		}
		$this->setRedirect( $redirect, $msg, 'notice' );
		return;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return return_type
	 */
	function addTag()
	{
	    $html = '';
	    
	    $elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );
		$helper = new MediaManagerHelperBase();
		$values = $helper->elementsToArray( $elements );
		$media_id = @$values['id'];
		
        if (empty($media_id))
        {
            // this is a new media item, so save the tag references in an array for storing upon save
            $mediatags = @$values['mediatags'];
            if (empty($mediatags)) { $mediatags = array(); }
            
            $existing_tag_id = @$values['existing_tag_id'];
            $new_tag_name = @$values['new_tag_name'];
            if (!empty($existing_tag_id))
            {
                // add using existing tag id
                $tag = $this->getModel( 'Tags' )->getTable();
                $tag->load( $existing_tag_id );
                
                $key = array_search($tag->tag_title, $mediatags);
                if ($key === false)
                {
                    $mediatags[] = $tag->tag_title;
                } 
                    else
                {
                    $html .= $helper->generateMessage( JText::_( "Tag already added" ) );
                }
            }
            elseif (!empty($new_tag_name))
            {
                // add using new tag name
                $tag = $this->getModel( 'Tags' )->getTable();
                $tag->tag_title = $new_tag_name;
                
                $key = array_search($tag->tag_title, $mediatags);
                if ($key === false)
                {
                    $mediatags[] = $tag->tag_title;
                } 
                    else
                {
                    $html .= $helper->generateMessage( JText::_( "Tag already added" ) );
                }                
            }
            else
            {
                // fail for invalid data
                $html .= $helper->generateMessage( JText::_( "Please provide a new tag name or select an existing one" ) );
            }
        }
        else
        {
            // add the tag to the media item immediately
            $existing_tag_id = @$values['existing_tag_id'];
            $new_tag_name = @$values['new_tag_name'];
            if (!empty($existing_tag_id))
            {
                // add using existing tag id
                $mediatag = $this->getModel( 'MediaTags' )->getTable();
                $mediatag->media_id = $media_id;
                $mediatag->tag_id = $existing_tag_id;
                if (!$mediatag->save())
                {
                    $html .= $helper->generateMessage( $mediatag->getError() );
                }
            }
            elseif (!empty($new_tag_name))
            {
                // add using new tag name
                $mediatag = $this->getModel( 'MediaTags' )->getTable();
                $mediatag->media_id = $media_id;

                $tag = $this->getModel( 'Tags' )->getTable();
                $tag->tag_title = $new_tag_name;
                if ($tag->exists())
                {
                    $messages = "<li>" . JText::_( "Used this existing tag instead of creating new one" ) . ": " . $tag->tag_title . "</li>";
                    $mediatag->tag_id = $tag->tag_id;
                    if (!$mediatag->save())
                    {
                        $messages .= "<li>" . $mediatag->getError() . "</li>";
                    }
                    $html .= $helper->generateMessage( $messages, false );
                } 
                    else 
                {
                    if ($tag->save())
                    {
                        $mediatag->tag_id = $tag->tag_id;
                        if (!$mediatag->save())
                        {
                            $html .= $helper->generateMessage( $mediatag->getError() );
                        }
                    }
                    else
                    {
                        $html .= $helper->generateMessage( $tag->getError() );
                    }
                }
            }
            else
            {
                // fail for invalid data
                $html .= $helper->generateMessage( JText::_( "Please provide a new tag name or select an existing one" ) );
            }
        }

        $model = $this->getModel( 'media' );
        
        $view = $this->getView( 'media', 'html' );
		$view->set( '_doTask', true );
		$view->set( 'hidemenu', false );
		$view->setLayout( 'form_tags' );
		$view->setModel( $model, true );

		$mtmodel = $this->getModel( 'MediaTags' );
		if (!empty($media_id))
		{
		    $mediatags = array();
		    $mtmodel->setState('order', 'tag.tag_title');
    		$mtmodel->setState('filter_media', $media_id);
    		$mediatags = $mtmodel->getList( true );		    
		}
		$view->assign( 'mediatags', $mediatags );
		ob_start();
		$view->display();
		$view_html = ob_get_contents();
		ob_end_clean();
		
		$html .= $view_html;
	    //$html .= MediaManager::dump( $values );
	    
		$response = array();
		$response['msg'] = $html;
		echo ( json_encode( $response ) );
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return return_type
	 */
	function removeTag()
	{
	    $html = '';
	    
	    $elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );
		$helper = new MediaManagerHelperBase();
		$values = $helper->elementsToArray( $elements );
		$media_id = @$values['id'];
		
        if (empty($media_id))
        {
            // this is a new media item, so remove the tag references from the array for storing upon save
            $mediatags = @$values['mediatags'];
            if (empty($mediatags)) { $mediatags = array(); }
            $tag_title = urldecode( JRequest::getVar('tag_title') );
            $key = array_search($tag_title, $mediatags);
            if ($key !== false)
            {
                unset($mediatags[$key]);
            }
        }
        else
        {
            // remove the tag from the media item immediately
            $mediatag_id = JRequest::getInt('mediatag_id');
            if (!empty($mediatag_id))
            {
                $mediatag = $this->getModel( 'MediaTags' )->getTable();
                if (!$mediatag->delete($mediatag_id))
                {
                    $html .= $helper->generateMessage( $mediatag->getError() );
                }
            }
            else
            {
                // fail for invalid data
                $html .= $helper->generateMessage( JText::_( "Invalid Media Tag" ) );
            }
        }

        $model = $this->getModel( 'media' );
        
        $view = $this->getView( 'media', 'html' );
		$view->set( '_doTask', true );
		$view->set( 'hidemenu', false );
		$view->setLayout( 'form_tags' );
		$view->setModel( $model, true );
		
		$mtmodel = $this->getModel( 'MediaTags' );
		if (!empty($media_id))
		{
		    $mediatags = array();
		    $mtmodel->setState('order', 'tag.tag_title');
    		$mtmodel->setState('filter_media', $media_id);
    		$mediatags = $mtmodel->getList( true );		    
		} 
		$view->assign( 'mediatags', $mediatags );
		ob_start();
		$view->display();
		$view_html = ob_get_contents();
		ob_end_clean();
		
		$html .= $view_html;
	    
		$response = array();
		$response['msg'] = $html;
		echo ( json_encode( $response ) );
	}
	
}
