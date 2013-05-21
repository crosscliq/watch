<?php
/**
* @version		0.1.0
* @package		Mediamanager
* @copyright	Copyright (C) 2011 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class Mediamanager extends DSC
{
    protected $_name = 'mediamanager';
    protected $_version 		= '1.0';
    protected $_build          = 'r100';
    protected $_versiontype    = 'community';
    protected $_copyrightyear 	= '2011';
    protected $_min_php		= '5.2';

    public $show_linkback = '1';
    public $amigosid = '';
    public $page_tooltip_dashboard_disabled = '0';
    public $page_tooltip_config_disabled = '0';
    public $page_tooltip_tools_disabled = '0';
    
    public $groups = 'slideshow
video
audio';
    public $library_pagination_limit = '8';
    public $item_id = '';
    public $library_id = '';
    
    public $video_default_width = '940';
    public $video_default_height = '627'; 
    
    /**
    * Returns the query
    * @return string The query to be used to retrieve the rows from the database
    */
    public function _buildQuery()
    {
        $query = "SELECT * FROM #__mediamanager_config";
        return $query;
    }
    
    /**
     * Get component config
     *
     * @acces	public
     * @return	object
     */
    public static function getInstance()
    {
        static $instance;
    
        if (!is_object($instance)) {
            $instance = new Mediamanager();
        }
    
        return $instance;
    }
    
    /**
     * Intelligently loads instances of classes in framework
     *
     * Usage: $object = Mediamanager::getClass( 'MediamanagerHelperCarts', 'helpers.carts' );
     * Usage: $suffix = Mediamanager::getClass( 'MediamanagerHelperCarts', 'helpers.carts' )->getSuffix();
     * Usage: $categories = Mediamanager::getClass( 'MediamanagerSelect', 'select' )->category( $selected );
     *
     * @param string $classname   The class name
     * @param string $filepath    The filepath ( dot notation )
     * @param array  $options
     * @return object of requested class (if possible), else a new JObject
     */
    public static function getClass( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_mediamanager' )  )
    {
        return parent::getClass( $classname, $filepath, $options  );
    }
    
    /**
     * Method to intelligently load class files in the framework
     *
     * @param string $classname   The class name
     * @param string $filepath    The filepath ( dot notation )
     * @param array  $options
     * @return boolean
     */
    public static function load( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_mediamanager' ) )
    {
        return parent::load( $classname, $filepath, $options  );
    }
    
    /**
    * Get the URL to the folder containing all media assets
    *
    * @param string	$type	The type of URL to return, default 'media'
    * @return 	string	URL
    */
    public static function getURL($type = 'media', $com='com_mediamanager')
    {
        $url = parent::getUrl($type, $com);
    
        switch($type)
        {
            case 'siteFiles':
                $url = JURI::root(true).'/images/com_mediamanager/files/';
                break;
            case 'siteImages':
                $url = JURI::root(true).'/images/com_mediamanager/images/';
                break;
            case 'siteAudio':
                $url = JURI::root(true).'/images/com_mediamanager/audio/';
                break;
            case 'siteVideo':
                $url = JURI::root(true).'/images/com_mediamanager/video/';
                break;
            case 'siteThumbs':
                $url = JURI::root(true).'/images/com_mediamanager/images/thumbs/';
                break;
            case 'media_thumbs':
                $url = JURI::root(true).'/images/com_mediamanager/media/thumbs/';
                break;
        }
    
        return $url;
    }
    
    /**
     * Get the path to the folder containing all media assets
     *
     * @param 	string	$type	The type of path to return, default 'media'
     * @return 	string	Path
     */
    public static function getPath($type = 'media', $com='com_mediamanager')
    {
        $path = parent::getPath($type, $com);
    
        switch($type)
        {
            case 'siteFiles':
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'files';
                break;
            case 'siteImages':
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'images';
                break;
            case 'siteAudio':
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'audio';
                break;
            case 'siteVideo':
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'video';
                break;
            case 'siteThumbs':
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'images'.DS.'thumbs';
                break;
            case 'media_thumbs' :
                $path = JPATH_SITE.DS.'images'.DS.'com_mediamanager'.DS.'media'.DS.'thumbs';
                break;
        }
    
        return $path;
    }
}
?>
