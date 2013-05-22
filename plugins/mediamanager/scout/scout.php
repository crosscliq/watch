<?php
/**
 * @version 1.5
 * @package Scout
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

/** Import library dependencies */
jimport('joomla.plugin.plugin');

class plgMediaManagerScout extends JPlugin
{
    function __construct( &$subject, $params )
    {
        parent::__construct( $subject, $params );
    }

    function onDisplayMediaItem( $plugin, $media_item ) {

        $element = JRequest::getVar( 'uuid', '', 'request', 'string' );
        


    if ( !class_exists('Mediamanager') ) {
             JLoader::register( "Mediamanager", JPATH_ADMINISTRATOR."/components/com_mediamanager/defines.php" );

    }
           $model =  MediaManager::getClass('MediaManagerModelStation','models.station',  $options=array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_mediamanager' )); 
           $uuid = $model->getUUID();
           $station = $model->getItembyUUID( $uuid );
    

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
                $scope_url = 'index.php?option=com_mediamanager&view=station&task=edit&cid[]=';
                break;
            case "0":
            default:
                $scope_url = 'index.php?option=com_mediamanager&view=station&id=';
                break;
        }
        // set the object
        $log->setObject(
            array(
                'value'=>$media_item->media_id,                          // required. the object's unique identifier. (in the case of content article, is the article id #)
                'name'=>$media_item->media_title,                        // required. the object's plain english name. 
                'scope_identifier'=>'com_mediamanager.station', // required. is unique to this site+component+view(+layout) combo
                'scope_name'=>'Media Station',       // optional. only necessary if this scope is a new one
                'scope_url'=>$scope_url,                        // optional. only necessary if this is a new scope, and this url is unique to this site+component+view(+layout) combo
                'client_id'=>$client_id                         // optional. if missing, log object sets it.
            )
        );   

         if (!$log->save())
        {
            JError::raiseNotice( 'plgMediaManagerScout', "plgMediaManagerScout :: ". $log->getError() );
        }

    }



    function onDisplayFileAjax(  ) {

        JTable::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_scout/tables' );
        $log = JTable::getInstance( 'Logs', 'ScoutTable' );

        // set the subject
        $log->setSubject(
            array(
                'value'=>$media_item->media_id,   // required. the subject's unique identifier, generally a user id # 
                'name'=>$media_item->media_title,  // required. the subject's name, generally a user's name or username.
                'type'=>'media'                      // optional. 'user' is the default
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
                $scope_url = 'index.php?option=com_mediamanager&view=station&task=edit&cid[]=';
                break;
            case "0":
            default:
                $scope_url = 'index.php?option=com_mediamanager&view=station&id=';
                break;
        }
        // set the object
        $log->setObject(
            array(
                'value'=>$media_item->media_id,                          // required. the object's unique identifier. (in the case of content article, is the article id #)
                'name'=>$media_item->media_title,                        // required. the object's plain english name. 
                'scope_identifier'=>'com_mediamanager.station', // required. is unique to this site+component+view(+layout) combo
                'scope_name'=>'Media Station',       // optional. only necessary if this scope is a new one
                'scope_url'=>$scope_url,                        // optional. only necessary if this is a new scope, and this url is unique to this site+component+view(+layout) combo
                'client_id'=>$client_id                         // optional. if missing, log object sets it.
            )
        );   

         if (!$log->save())
        {
            JError::raiseNotice( 'plgMediaManagerScout', "plgMediaManagerScout :: ". $log->getError() );
        }

    }

}
