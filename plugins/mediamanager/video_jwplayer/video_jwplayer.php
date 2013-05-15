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

class plgMediaManagerVideo_Jwplayer extends MediaManagerPluginBase
{
	public $_element = 'video_jwplayer';
	public $dot_path_prefix = 'video_jwplayer.';
	public $path_prefix = 'video_jwplayer/';
	public $plain_name = 'VideoJwplayer'; 
	public $full_path = '';
	public $relative_path = '';
	
	function plgMediaManagerVideo_Jwplayer( &$subject, $config )
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
		            elseif ( !empty($db_file->file_name) && JFile::exists( JPATH_SITE . DS . $db_file->file_path . DS . $db_file->file_name ) )
		        {
		            $file = substr( JURI::root(), 0, -1 ) . $db_file->file_path . "/" . $db_file->file_name;
		            $db_file->file = str_replace( "\\", "/", $file );
		        }
		    }
		}
		
		$vars->db_files = $db_files;
		$vars->db_files_count = count( $db_files );
		
		$vars->config = MediaManager::getInstance();
        $vars->width = $media_item->params->get( 'videojwplayer_width', $vars->config->get( 'video_default_width' ) );
        $vars->height = $media_item->params->get( 'videojwplayer_height', $vars->config->get( 'video_default_height' ) );
        
        $media = JTable::getInstance( 'Media', 'MediaManagerTable' );
        $media->load( $media_item->media_id );
        
        $image = (!empty($media_item->media_image_remote)) ? $media_item->media_image_remote : JURI::root() . $media_item->media_image;
        if (empty($image) && !empty($media_item->media_image)) 
        {
            $full_image_path = $media->getImagePath();
            if (JFile::exists( $full_image_path . DS . $media_item->media_image )) 
            {
                $full_image_url = $media->getImageUrl() . $media_item->media_image;
                $image = $full_image_url;
            }
        }  
        $vars->image = $image;
                		
		$html = $this->_getLayout( 'view', $vars );
		
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
        MediaManager::load( 'MediaManagerSelect' . $this->plain_name, $this->dot_path_prefix . 'video_jwplayer.library.select', array( 'site'=>'site', 'type'=>'plugins', 'ext'=>'mediamanager' ) );
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
        $fields = array( $table->getKeyName(), 'name', 'caption', 'url', 'url_target', 'enabled', 'ordering' );
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
                        // and create the corresponding row in the video_jwplayer table
                        $videojwplayer_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                        $videojwplayer_table->media_id = $media_item->media_id;
                        $videojwplayer_table->mediafile_id = $mediafile->mediafile_id;
                        if (!$videojwplayer_table->save())
                        {
                            JFactory::getApplication()->enqueueMessage( $videojwplayer_table->getError(), 'notice' );
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
			if (!$table->store()) {
			    JFactory::getApplication()->enqueueMessage($table->getError(), 'notice');
			}
		}
		
		// reorder
		$table->save();
		
        // set params based on post
        $params = new DSCParameter( trim($media_item->media_params) );

		$params->set('videojwplayer_auto_play', $post['videojwplayer_auto_play']);
		$params->set('videojwplayer_width', $post['videojwplayer_width']);
		$params->set('videojwplayer_height', $post['videojwplayer_height']);
		$params->set('videojwplayer_controlbar_position', $post['videojwplayer_controlbar_position']);
		$params->set('videojwplayer_show_icons', $post['videojwplayer_show_icons']);
		$params->set('videojwplayer_buffer_length', $post['videojwplayer_buffer_length']);
		$params->set('videojwplayer_loop', $post['videojwplayer_loop']);
		
		
		
        // Save all of the new remote files being added
        $item_remote_new = JRequest::getVar( 'item_remote_new' );
        if (!empty($item_remote_new))
        {
            jimport('joomla.filesystem.file');
            $file = JTable::getInstance( 'Files', 'MediaManagerTable' );
            $file->file_url = $item_remote_new;
            $file->file_extension = JFile::getExt( $file->file_url );
            $file->file_name = JFile::getName( $file->file_url );
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
                    // and create the corresponding row in the video_jwplayer table
                    $videojwplayer_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $videojwplayer_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $videojwplayer_table->media_id = $media_item->media_id;
                    $videojwplayer_table->mediafile_id = $mediafile->mediafile_id;
                    $videojwplayer_table->enabled = '1';
                    if (!$videojwplayer_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $videojwplayer_table->getError(), 'notice' );
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
        
        $model = JModel::getInstance( $this->plain_name, 'MediaManagerModel' );
        $model->clearCache();
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
                    // and create the corresponding row in the video_jwplayer table
                    $videojwplayer_table = JTable::getInstance( $this->plain_name,'MediaManagerTable');
                    $videojwplayer_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $videojwplayer_table->media_id = $media_item->media_id;
                    $videojwplayer_table->mediafile_id = $mediafile->mediafile_id;
                    $videojwplayer_table->enabled = '1';
                    if (!$videojwplayer_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $videojwplayer_table->getError(), 'notice' );
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
                    // and create the corresponding row in the video_jwplayer table
                    $videojwplayer_table = JTable::getInstance($this->plain_name,'MediaManagerTable');
                    $videojwplayer_table->load( array( 'mediafile_id'=>$mediafile->mediafile_id, 'media_id'=>$media_item->media_id ) );
                    $videojwplayer_table->media_id = $media_item->media_id;
                    $videojwplayer_table->mediafile_id = $mediafile->mediafile_id;
                    if (!$videojwplayer_table->save())
                    {
                        JFactory::getApplication()->enqueueMessage( $videojwplayer_table->getError(), 'notice' );
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
            $table = JTable::getInstance($this->plain_name, 'MediaManagerTable');
            $table->load( array( 'mediafile_id'=>$delete_id ) );
            $table->delete();
        }
    
        return $this->getFilesHtml( $id );
    }
    
    protected function getFilesHtml( $id )
    {
        $model = JModel::getInstance('Media', 'MediaManagerModel');
        $media_item = $model->getTable();
        $media_item->load( $id );
    
        $vars = new JObject();
        $vars->row = $media_item;
    
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
    
        MediaManager::load( 'MediaManagerSelect' . $this->plain_name, $this->dot_path_prefix . 'video_jwplayer.library.select', array( 'site'=>'site', 'type'=>'plugins', 'ext'=>'mediamanager' ) );
    
        $html = $this->_getLayout( 'form_files', $vars );
    
        return $html;
    }
}
