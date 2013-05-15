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

class MediaManagerControllerFiles extends MediaManagerController
{
    function __construct() 
    {
        parent::__construct();
        
        $this->set('suffix', 'files');
        
        $this->registerTask( 'file_enabled.enable', 'boolean' );
        $this->registerTask( 'file_enabled.disable', 'boolean' );
    }
    
    /**
    * Sets the model's default state based on values in the request
    *
    * @return array()
    */
    function _setModelState( )
    {
        $state = parent::_setModelState( );
        $app = JFactory::getApplication( );
        $model = $this->getModel( $this->get( 'suffix' ) );
        $ns = $this->getNamespace( );
    
        $state = array( );
    
        $state['filter_urlpath'] = $app->getUserStateFromRequest( $ns . 'filter_urlpath', 'filter_urlpath', '', '' );
    
        foreach ( @$state as $key => $value )
        {
            $model->setState( $key, $value );
        }
        return $state;
    }
    
    public function save() 
    {
        if ($row = parent::save()) 
        {
            $fieldname = 'new_file';
            $userfile = JRequest::getVar( $fieldname, '', 'files', 'array' );
            if ( !empty( $userfile['size'] ) )
            {
                $this->row = $row;
                if ( $upload = $this->addFile( $fieldname, $row->getFilePath( ) ) )
                {
                    $row->file_extension = $upload->getExtension( );
                    $row->file_path = $upload->getDirectory();
                    $row->file_name = $upload->getPhysicalName( );
                    $row->save();
                }
                else
                {
                    JFactory::getApplication( )->enqueueMessage( $upload->getError( ), 'notice' );
                }
            }            
        }
    }
    
    /**
    * Adds an image to item
    * @return unknown_type
    */
    private function addFile( $fieldname = 'new_file', $path = null )
    {
        $row = $this->row;
    
        MediaManager::load( 'MediaManagerImage', 'library.image' );
        $upload = new MediaManagerImage( );
    
        // handle upload creates upload object properties
        $upload->handleUpload( $fieldname );
    
        // then save image to appropriate folder
        if ( empty( $path ) )
        {
            $path = $row->getFilePath();
        }
        $upload->setDirectory( $path );
    
        // do upload!
        $upload->upload( );

        /*
        // TODO get thumb dimensions from somewhere in a config
        $options = array( );
        $options['width'] = 170;
        $options['height'] = 120;
        $options['thumb_path'] = $row->getThumbPath();
    
        $copy = $upload;
        if (!$copy->saveThumb( $copy ))
        {
            JFactory::getApplication()->enqueueMessage( $copy->getError(), 'notice' );
        }
        */
    
        return $upload;
    }
}