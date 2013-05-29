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

class MediaManagerControllerStation extends MediaManagerController
{
	function __construct() 
	{
		parent::__construct();
		$this->set('suffix', 'station');
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
        $model = $this->getModel( 'station' );
        $uuid = $model->getUUID();
  
        $station = $model->getItembyUUID( $uuid );
       //  var_dump($station);
        
        if (empty($station->media_id) || empty($station->media->media_type) || empty($station->media->media_enabled))
        {
            JError::raiseNotice( '', 'D1: Invalid Media' );
            return;
        }
        
        $hmodel = $this->getModel( 'handlers' );
        $handler = $hmodel->getTable();
      
        $handler->load( array( 'element'=>$station->media->media_type ) );
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
        $results = $dispatcher->trigger( 'onDisplayMediaItem', array( $handler, $station->media ) );
        
        for ($i=0; $i<count($results); $i++) 
        {
            $html .= $results[$i];
        }

       /* $station->media->categories = array();
        foreach ($station->media->mediacategories as $mc)
        {
            if (empty($station->media->categories[$mc->categorytype_id]))
            {
                $station->media->categories[$mc->categorytype_id] = array();
            }
            $station->media->categories[$mc->categorytype_id][] = $mc; 
        }*/
        
        $view   = $this->getView( 'station', 'html' );
        $view->set( '_doTask', true);
        $view->set( 'hidemenu', true);
        $view->setModel( $model, true );
        $view->setModel( $hmodel );
        $view->set('handler', $handler);
        $view->set('handler_html', $html);

    	//$ctmodel = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
        //$ctitems = $ctmodel->getList(false);
        //$view->assign('category_types', $ctitems);
        
       
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
		/*if (!empty($hstate['library_id']))
		{
		    $library = $this->getModel('libraries')->getTable();
		    $library->load( $hstate['library_id'] );
		    $view->assign( 'library', $library );
		    
    		$lctmodel = JModel::getInstance( 'LibraryCategoryTypes', 'MediaManagerModel' );
    		$lctmodel->setState( 'filter_library', $library->library_id );
            $lctitems = $lctmodel->getList();
            $library_category_types = $helper->getColumn( $lctitems, 'categorytype_id' );
		}*/
        //$view->assign('library_category_types', $library_category_types);
        
        //$document = JFactory::getDocument();
        //$page_title = $station->media->media_title;
        //$page_title .= " | " . ucwords($station->media->media_group);
        //$document->setTitle( strip_tags( htmlspecialchars_decode( $page_title ) ) );
        //$document->setDescription( strip_tags( htmlspecialchars_decode( $station->media->media_description ) ) );
        
       // $document->addCustomTag( "<meta property='og:image' content='" . JURI::root() . $station->media->media_image . "' />" );
        
        // TODO Add support for this, but we need a helper function.  See https://developers.facebook.com/docs/opengraph/complextypes/
        //$document->addCustomTag( "<meta property='og:type' content='$station->media->media_group' />" );
        
       
        
        JRequest::setVar( 'layout', 'view' );
      
        //$view->display();
        parent::display($cachable, $urlparams);
	}
	
	
    function logs() {
       
        $string = file_get_contents($_FILES['files']['tmp_name']);
        $string = trim($string);
        $string = substr( $string , strpos($string, '000000'));


        $data = array_chunk(str_getcsv($string, ','), '11'); 

        var_dump($data);

      foreach ($data  as $row) {
        /*
        $row[0] == timestamps of seconds passed the time of the file is created;
        $row[1] == USB PORT 1
        $row[2] == USB PORT 2
        $row[3] == USB PORT 3
        $row[4] == USB PORT 4
        $row[5] == USB PORT 5
        $row[6] == USB PORT 6
        $row[7] == USB PORT 7
        $row[8] == USB PORT 8
        */
      }


       /* //lets save the file to disk;
        var_dump($_FILES);
        $uploaddir = MediaManager::getPath() . '/logs/';
        $uploadfile = $uploaddir . basename($_FILES['files']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}*/


        die();
    }

    function displaylog() {
        

        $mediafileid = JRequest::getVar('mfid', null, 'request', 'int');

        $datetime = JRequest::getVar('dt', null, 'request', 'string');
        
        $model =  MediaManager::getClass('MediaManagerModelStation','models.station',  $options=array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_mediamanager' )); 
        $uuid = $model->getUUID();
        $station = $model->getItembyUUID( $uuid );
        

        $model =  MediaManager::getClass('MediaManagerModelMediafiles','models.mediafiles'); 
        $media_item = $model->getItem($mediafileid);

        JTable::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_scout/tables' );
        $log = JTable::getInstance( 'Logs', 'ScoutTable' );

        // set the subject
        $log->setSubject(
            array(
                'value'=>$station->station_id,   // required. the subject's unique identifier, generally a user id # 
                'name'=>$station->station_name,  // required. the subject's name, generally a user's name or username.
                'type'=>'station'                      // optional. 'user' is the default
            )
        ); 

        // set the verb's variables
        $verbValue = 'displayed';
        $verbName = 'Displayed';
        // set the verb
        $log->setVerb(
            array(
                'value'=>$verbValue,    // required. unique identifier for this action
                'name'=>$verbName       // optional. if this is a new verb, this is the plain English name for it
            )
        );


         // set the object's variables
        $app = JFactory::getApplication();
        $client_id = $app->isAdmin() ? '1' : '0';
        switch($client_id)
        {
            case "1":
                $scope_url = 'index.php?option=com_mediamanager&view=mediafile&task=edit&cid[]=';
                break;
            case "0":
            default:
                $scope_url = 'index.php?option=com_mediamanager&view=mediafile&task=edit&cid[]=';
                break;
        }


        // set the object
        $log->setObject(
            array(
                'value'=>$media_item->mediafile_id,                          // required. the object's unique identifier. (in the case of content article, is the article id #)
                'name'=>$media_item->file_name,                        // required. the object's plain english name. 
                'scope_identifier'=>'com_mediamanager.mediafile', // required. is unique to this site+component+view(+layout) combo
                'scope_name'=>'Media File',       // optional. only necessary if this scope is a new one
                'scope_url'=>$scope_url,                        // optional. only necessary if this is a new scope, and this url is unique to this site+component+view(+layout) combo
                'client_id'=>$client_id                         // optional. if missing, log object sets it.
            )
        );   

         if (!$log->save())
        {   

            $msg = array();
            $msg['response'] = 'false';
            $msg['msg'] = $log->getError();
        } else {
            $msg = array();
            $msg['response'] = 'true';
            $msg['msg'] = 'display logged';

        }

        echo json_encode($msg);
       

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