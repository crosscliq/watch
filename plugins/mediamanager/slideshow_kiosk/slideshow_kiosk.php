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

MediaManager::load( 'MediaManagerPluginBase', 'library.plugin.base' );

class plgMediaManagerSlideshow_Kiosk extends MediaManagerPluginBase
{
	public $_element = 'slideshow_kiosk';	
	public $dot_path_prefix = 'slideshow_kiosk.';
	public $path_prefix = 'slideshow_kiosk/';
	public $plain_name = 'SlideshowKiosk';
	public $full_path = '';
	public $relative_path = '';
	
	function plgMediaManagerSlideshow_Kiosk( &$subject, $config )
	{
		parent::__construct( $subject, $config );
		
		if (!version_compare(JVERSION,'1.6.0','ge')) 
		{
		    $this->dot_path_prefix = '';
		    $this->path_prefix = '';
		}
		$this->full_path = JPATH_SITE . '/plugins/mediamanager/' . $this->path_prefix . $this->_element;
		$this->relative_path = 'plugins/mediamanager/' . $this->path_prefix . $this->_element;
		
		MediaManager::load( 'MediaManagerUrl', 'library.url' );
		$this->loadLanguage( '', JPATH_ADMINISTRATOR );
		
		// check that the tables exist
		$helper = MediaManager::getClass( 'MediaManagerHelperDiagnostic' . $this->plain_name, $this->dot_path_prefix . $this->_element . '.helper.diagnostic', array( 'site' => 'site', 'type' => 'plugins', 'ext' => 'mediamanager' ) );
		$helper->checkInstallation();
		
		// this adds the plugin's models & tables to the stack
		JTable::addIncludePath( $this->full_path . '/tables' );
		JModel::addIncludePath( $this->full_path . '/models' );
		
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
	}
	
	/**
	 * Displays a media item
	 * 
	 * @param $plugin
	 * @param $media_item
	 * @return unknown_type
	 */
	public function onDisplayMediaItem( $plugin, $media_item )
	{
		if ( !$this->_isMe( $plugin ) )
		{
			return null;
		}
		
		$vars = new JObject();
		$vars->row = $media_item;
		$vars->element = $this->_element;
		$vars->dot_path_prefix = $this->dot_path_prefix;
		$vars->path_prefix = $this->path_prefix;
		$vars->full_path = $this->full_path;
		$vars->relative_path = $this->relative_path;
		
		MediaManager::load( 'MediaManagerHelperMedia', 'helpers.media' );
		
		$model = JModel::getInstance( $this->plain_name, 'MediaManagerModel' );
		$model->setState( 'filter_media', ( int ) $media_item->media_id );
		$model->setState( 'filter_enabled', '1' );
		$model->setState( 'filter_published', '1' );
		$model->setState( 'order', 'tbl.ordering' );
		$model->setState( 'direction', 'ASC' );
		if ($db_files = $model->getList())
		{
		    foreach ($db_files as $db_file)
		    {
		        $db_file->file = '';
		        if (!empty($db_file->file_url))
		        {
		            $db_file->file = $db_file->file_url;
		        }
		        elseif ( !empty($db_file->file_path) && JFile::exists( JPATH_SITE . DS . $db_file->file_path ) )
		        {
		            $file = JURI::root() . $db_file->file_path;
		            $db_file->file = str_replace( "\\", "/", $file );
		        }
		    }
		}
		
		$vars->db_files = $db_files;
		$vars->db_files_count = count( $db_files );
		
        $layout = JRequest::getVar('format', 'view');


		$html = $this->_getLayout( $layout, $vars );
		
		return $html;
	}
	
    /**
     * Render the edit media item form section that pertains to this slideshow type
     * 
     * @param unknown_type $row
     * @param unknown_type $media
     * @return unknown_type
     */
    public function onEditMedia( $plugin, $media_item )
    {
        if (!$this->_isMe($plugin)) 
        {
            return null;
        }
        
        MediaManager::load( 'MediaManagerSelect', 'library.select' );
        MediaManager::load( 'MediaManagerSelect' . $this->plain_name, $this->dot_path_prefix . 'slideshow_kiosk.library.select', array( 'site'=>'site', 'type'=>'plugins', 'ext'=>'mediamanager' ) );
        MediaManager::load('MediaManagerHelperBase','helpers.base');
        MediaManager::load('MediaManagerHelperMedia','helpers.media');

        JHTML::_( 'script', 'admin.js', $this->relative_path . '/js/');
        
        $model = JModel::getInstance('MediaFiles', 'MediaManagerModel');
        $model->setState( 'filter_media', (int) $media_item->media_id );
        $model->setState( 'order', 'element_tbl.ordering' );
        $model->setState( 'direction', 'ASC' );
        
        $table = JTable::getInstance($this->plain_name,'MediaManagerTable');        
        $query = $model->getQuery();
        $query->join('LEFT', '#__mediamanager_'. $this->_element.' AS element_tbl ON tbl.mediafile_id = element_tbl.mediafile_id');
        $fields = array( $table->getKeyName(), 'name', 'caption', 'url', 'url_target', 'enabled', 'ordering', 'publish_up', 'publish_down' );
        $query->select( $fields );
        $model->setQuery( $query );
        
        $db_files = $model->getList();
      
        $vars = new JObject();
        $vars->row = $media_item;

		$plugin_file = JPluginHelper::getPlugin('mediamanager', $this->_element );
		$vars->params = new DSCParameter( $plugin_file->params );
        
        // lets grab any existing images in the filesystem
        $media_helper = new MediaManagerHelperMedia();
        $gallery_images = $media_helper->getGalleryImages( $media_helper->getGalleryPath( @$vars->row->media_id ) );
        
        $helper = new MediaManagerHelperBase();
        $filenames_from_db = $helper->getColumn( $db_files, 'file_name' );

        /* TODO Finish this
        // were any files uploaded via FTP directly to the media folder? 
        $added_image = false;
        foreach ($gallery_images as $image)
        {
            if (!in_array($image, $filenames_from_db))
            {
                // add the image to the files DB for this media
                $added_image = true;
                
                // create a record of it in the files DB table
                $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
                $file->file_name = strtolower( $image );
                $file->file_path = $media_helper->getGalleryPath( $media_item->media_id );
                $file->file_extension = JFile::getExt( $image );
                if ($file->save())
                {
                    // Create a thumb for it if no thumb exists
                    $dest = MediaManager::getPath('siteImages') . '/' . $media_item->media_id.'/thumbs/'.$image;
                    if (!JFile::exists( $dest ))
                    {
                        $src = MediaManager::getPath('siteImages') . '/' . $media_item->media_id . '/' . $image;
                        JFile::copy( $src, $dest );
                        
                        MediaManager::load( 'MediaManagerImage', 'library.image' );
                        $image_file = new MediaManagerImage( $dest );

                        $options = array( 'width'=>170, 'height'=>120 );
                        MediaManager::load( 'MediaManagerHelperImage', 'helpers.image' );
                        $imgHelper = MediaManagerHelperBase::getInstance('Image', 'MediaManagerHelper');
                        if (!$imgHelper->resizeImage( $image_file, 'item', $options))
                        {
                            JFactory::getApplication()->enqueueMessage( $imgHelper->getError(), 'notice' );
                        }
                    }
                    
                    // add this file to this media item
                    $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                    $mediafile->file_id = $file->file_id;
                    $mediafile->media_id = $media_item->media_id;
                    if ($mediafile->save())
                    {
                        // and create the corresponding row in the slideshow_kiosk table
                        $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                        $slideshowdefault_table->media_id = $media_item->media_id;
                        $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                        if (!$slideshowdefault_table->save())
                        {
                            JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                        }
                    }
                        else
                    {
                        JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                    }
                    
                }
                    else
                {
                    JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
                }
            }

            // does a thumb exist?
            $dest = MediaManager::getPath('siteImages') . '/' . $media_item->media_id.'/thumbs/'.$image;
            if (!JFile::exists( $dest ))
            {
                $src = MediaManager::getPath('siteImages') . '/' . $media_item->media_id . '/' . $image;
                JFile::copy( $src, $dest );
                
                MediaManager::load( 'MediaManagerImage', 'library.image' );
                $image_file = new MediaManagerImage( $dest );

                $options = array( 'width'=>170, 'height'=>120 );
                MediaManager::load( 'MediaManagerHelperImage', 'helpers.image' );
                $imgHelper = MediaManagerHelperBase::getInstance('Image', 'MediaManagerHelper');
                if (!$imgHelper->resizeImage( $image_file, 'item', $options))
                {
                    JFactory::getApplication()->enqueueMessage( $imgHelper->getError(), 'notice' );
                }
            }
            
        }

        if ($added_image)
        {
            // refresh
            $db_files = $model->getList( true );
        }
        */

		$vars->list = $db_files;
		
        $html = $this->_getLayout( 'form', $vars);
        
        return $html;
    }
    
    /**
     * Save the media item form's section that pertains to this slideshow type
     * 
     * @param unknown_type $row
     * @param unknown_type $media
     * @return unknown_type
     */
    public function onAfterSaveMedia( $media_item )
    {
        if ($media_item->media_type != $this->_element)
        {
            return;
        }
        
        $post = JRequest::get('post');

        $table = JTable::getInstance($this->plain_name, 'MediaManagerTable');
        $model = JModel::getInstance($this->plain_name, 'MediaManagerModel');
        
        $ids = JRequest::getVar('mediafile_ids', array(), 'post', 'array');
        $captions = JRequest::getVar('caption', array(), 'post', 'array');
        $urls = JRequest::getVar('url', array(), 'post', 'array');
        $urltargets = JRequest::getVar('url_target', array(), 'post', 'array'); 
        $enabled = JRequest::getVar('enabled', array(), 'post', 'array');
        $delete = JRequest::getVar('delete', array(), 'post', 'array');
        $names = JRequest::getVar('name', array(), 'post', 'array');
        $ordering = JRequest::getVar('ordering', array(), 'post', 'array');
        $up = JRequest::getVar('publish_up', array(), 'post', 'array');
        $down = JRequest::getVar('publish_down', array(), 'post', 'array');
        
		foreach ($ids as $id)
		{
		    $table->load( array('mediafile_id'=>$id) );
		    $table->media_id = $media_item->media_id;
		    $table->mediafile_id = $id;
		    $table->name = $names[$id];
			$table->caption = $captions[$id];
			$table->url = $urls[$id];
			$table->url_target = $urltargets[$id];
			$table->enabled = $enabled[$id];
			$table->ordering = $ordering[$id];
			$table->publish_up = $up[$id];
			$table->publish_down = $down[$id];
			if (!$table->save()) {
			    JFactory::getApplication()->enqueueMessage($table->getError(), 'notice');
			}
		}
		
		// reorder
		$table->save();
		
        // set params based on post
        $params = new DSCParameter( trim($media_item->media_params) );
        $params->set('slideshowdefault_include_jquery', $post['slideshowdefault_include_jquery']);
		$params->set('slideshowdefault_show_caption', $post['slideshowdefault_show_caption']);
		$params->set('slideshowdefault_autoplay', $post['slideshowdefault_autoplay']); 
		$params->set('slideshowdefault_auto_play_delay', $post['slideshowdefault_auto_play_delay']);
		$params->set('slideshowdefault_show_controls',$post['slideshowdefault_show_controls']);
		$params->set('slideshowdefault_slide_width', $post['slideshowdefault_slide_width']);
		$params->set('slideshowdefault_slide_height', $post['slideshowdefault_slide_height']);
		$params->set('slideshowdefault_container_width', $post['slideshowdefault_container_width']);
		$params->set('slideshowdefault_container_height', $post['slideshowdefault_container_height']);
		$params->set('slideshowdefault_loop', $post['slideshowdefault_loop']);
		$params->set('slideshowdefault_speed', $post['slideshowdefault_speed']);
		
        // Save all of the new remote images being added
        $item_imageremote_new = JRequest::getVar( 'item_remote_new' );
        if (!empty($item_imageremote_new))
        {
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->file_url = $item_imageremote_new;
            $file->file_extension = JFile::getExt( $file->file_url );
            $file->file_name = JFile::getName( $file->file_url );
            if ($file->save())
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the slideshow_kiosk table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                    else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
                
            }
                else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        }
        
        		
            // Save all of the new local files being added
        $item_local_new = JRequest::getVar( 'item_local_new' );
        if (!empty($item_local_new))
        {
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            //$file->file_url = $item_local_new;
            $file->file_path = $item_local_new;
            $file->file_extension = JFile::getExt( $file->file_path );
            $file->file_name = JFile::getName( $file->file_path );
            $file->file_enabled = true;
            if ($file->save())
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the document_pdf table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    $slideshowdefault_table->enabled = '1';
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
        
            }
            else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        }
		
        // save
        $media_item->media_params = trim( $params->toString() );        
        $media_item->store();
    }
    
    /**
     * 
     * @return unknown_type
     */
    protected function addimage( $fieldname = 'product_full_image_new', $num = 0, $path = 'siteImages' )
    {
        MediaManager::load( 'MediaManagerImage', 'library.image' );
        $image = new MediaManagerImage();
        // handle upload creates upload object properties
        $image->handleMultipleUpload( $fieldname, $num );

        
        // then save image to appropriate folder
        if ($path == 'siteImages') { $path = MediaManager::getPath( 'siteImages' ); }
        $image->setDirectory( $path );
        // Do the real upload!
        $image->upload();

        // TODO get thumb dimensions from somewhere in a config
        $copy = $image;
        if (!$copy->saveThumb( $copy )) 
        {
            JFactory::getApplication()->enqueueMessage( $copy->getError(), 'notice' );
        }

        return $image;
    }
    
    public function addNewFile( $plugin )
    {
        if ( !$this->_isMe( $plugin ) )
        {
            return null;
        }
    
        $elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );


        $helper = new DSCHelper();
        $values = $helper->elementsToArray($elements);
       
        $model = JModel::getInstance('Media', 'MediaManagerModel');
        $media_item = $model->getTable();

        $id = $values['id'];
        $media_item->load( $id );


    
        if (!empty($values['item_remote_new']) && !empty($values['add_type']) && $values['add_type'] == 'add_new_file')
        {
            $item_remote_new = $values['item_remote_new'];
    
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->file_url = $item_remote_new;
            $file->file_extension = JFile::getExt( $file->file_url );
            $file->file_name = JFile::getName( $file->file_url );
            $file->file_enabled = '1';
            if ($file->save())
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the slideshow_kiosk table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    $slideshowdefault_table->enabled = '1';
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
    
            }
            else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        }
    
        if (!empty($values['item_existing_new']) && !empty($values['add_type']) && $values['add_type'] == 'add_existing_file')
        {
            $item_existing_new = $values['item_existing_new'];
    
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->load($item_existing_new);
            if (!empty($file->file_id))
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the slideshow_kiosk table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
    
            }
            else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        }
        
        if (!empty($values['item_local_new']) && !empty($values['add_type']) && $values['add_type'] == 'add_new_file_local')
        {
            $item_local_new = $values['item_local_new'];
        
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->file_path = $item_local_new;
            $file->file_extension = JFile::getExt( $file->file_path );
            $file->file_name = JFile::getName( $file->file_path );
            $file->file_enabled = '1';


            if ($file->save())
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the slideshow_kiosk table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    $slideshowdefault_table->enabled = '1';
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
        
            }
            else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        }
    
        return $this->getFilesHtml( $id );
    }

    public function addNewVideo( $plugin )
    {
        if ( !$this->_isMe( $plugin ) )
        {
            return null;
        }
    
        $elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );



        $helper = new DSCHelper();
        $values = $helper->elementsToArray($elements);

        $model = JModel::getInstance('Media', 'MediaManagerModel');
        $media_item = $model->getTable();

        $id = $values['id'];
        $media_item->load( $id );
            //mp4
            if(strlen($values['video_params']['mp4'])) {
                $item_remote_new = $values['video_params']['mp4'];
            }
            //ogg better than mp4 rulezzzzz all
            if(strlen($values['video_params']['ogg'])) {
                $item_remote_new = $values['video_params']['ogg'];
            }
            //webm rulezzzzz all
            if(strlen($values['video_params']['webm'])) {
                  $item_remote_new = $values['video_params']['webm'];
            }
            

            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->file_url = $item_remote_new;
          //  $file->file_extension = 'html5video';
            $file->file_title = $values['video_title'];
            $file->file_params = serialize($values['video_params']);
            $file->file_extension = JFile::getExt( $file->file_url );
            $file->file_name = JFile::getName( $file->file_url );
            $file->advertiser_id = $values['video_advertiser_id'];
            $file->file_enabled = '1';
            if ($file->save())
            {
                // add this file to this media item
                $mediafile = JTable::getInstance( 'MediaFiles', 'MediaManagerTable' );
                $mediafile->load( array( 'file_id'=>$file->file_id, 'media_id'=>$media_item->media_id ) );
                $mediafile->file_id = $file->file_id;
                $mediafile->media_id = $media_item->media_id;
                if ($mediafile->save())
                {
                    // and create the corresponding row in the slideshow_kiosk table
                    $slideshowdefault_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $slideshowdefault_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $slideshowdefault_table->media_id = $media_item->media_id;
                    $slideshowdefault_table->mediafile_id = $mediafile->mediafile_id;
                    $slideshowdefault_table->enabled = '1';
                    if (!$slideshowdefault_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $slideshowdefault_table->getError(), 'notice' );
                    }
                }
                else
                {
                    JFactory::getApplication()->enqueueMessage( $mediafile->getError(), 'notice' );
                }
    
            }
            else
            {
                JFactory::getApplication()->enqueueMessage( $file->getError(), 'notice' );
            }
        
    
    
        return $this->getFilesHtml( $id );
    }


    
    public function deleteFile( $plugin )
    {
        if ( !$this->_isMe( $plugin ) )
        {
            return null;
        }
    
        $elements = json_decode( preg_replace('/[\n\r]+/', '\n', JRequest::getVar( 'elements', '', 'post', 'string' ) ) );
        $helper = new DSCHelper();
        $values = $helper->elementsToArray($elements);
    
        $model = JModel::getInstance('Media', 'MediaManagerModel');
        $media_item = $model->getTable();
        $id = $values['id'];
        $media_item->load( $id );
    
        $delete_id = JRequest::getInt('delete_id');
    
        if (!empty($delete_id))
        {
            $table = JTable::getInstance($this->plain_name,'MediaManagerTable');
            $table->load( array( 'mediafile_id'=>$delete_id ) );
            $table->delete();
        }
    
        return $this->getFilesHtml( $id );
    }
    
    protected function getFilesHtml( $id )
    {   

            MediaManager::load( 'MediaManagerModelMedia', 'models.media' );
        $model = JModel::getInstance('Media', 'MediaManagerModel');
        
        $media_item = $model->getTable();
        $media_item->load( $id );
    
        $vars = new JObject();
        $vars->row = $media_item;
         MediaManager::load( 'MediaManagerModelMediaFiles', 'models.mediafiles' );
        $model = JModel::getInstance('MediaFiles', 'MediaManagerModel');
        $model->setState( 'filter_media', (int) $media_item->media_id );
        $model->setState( 'order', 'element_tbl.ordering' );
        $model->setState( 'direction', 'ASC' );
        $table = JTable::getInstance($this->plain_name,'MediaManagerTable');
        $query = $model->getQuery();
        $query->join('LEFT', '#__mediamanager_'. $this->_element.' AS element_tbl ON tbl.mediafile_id = element_tbl.mediafile_id');
        $fields = array( $table->getKeyName(), 'name', 'caption', 'url', 'url_target', 'enabled', 'ordering', 'publish_up', 'publish_down' );
        $query->select( $fields );
        
        $model->setQuery( $query );
        $model->_list = array(); // preserves the query but forces a refresh

        $db_files = $model->getList();        
       
        
        $vars->list = $db_files;
    
        MediaManager::load( 'MediaManagerSelect' . $this->plain_name, $this->dot_path_prefix . 'slideshow_kiosk.library.select', array( 'site'=>'site', 'type'=>'plugins', 'ext'=>'mediamanager' ) );
    
        $html = $this->_getLayout( 'form_files', $vars );
        

        return $html;
    }
}
