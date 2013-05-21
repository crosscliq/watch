<?php
/**
* @version		0.1.0
* @package		Locator
* @copyright	Copyright (C) 2011 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class Locator extends DSC
{
    protected $_name = 'locator';
    protected $_version 		= '1.0';
    protected $_build          = 'r100';
    protected $_versiontype    = '';
    protected $_copyrightyear 	= '2012';
    protected $_min_php		= '5.3';

    // View Options
    public $show_linkback						= '1';
    public $include_site_css                   = '1';
    public $amigosid                           = '';
    public $page_tooltip_dashboard_disabled	= '0';
    public $page_tooltip_config_disabled		= '0';
    public $page_tooltip_tools_disabled		= '0';
    
    
    
    /**
     * Retrieves the data, using a cached set if possible
     *
     * @return array Array of objects containing the data from the database
     */
    public function getData()
    {
        $cache = JFactory::getCache('com_locator.defines');
        $cache->setCaching(true);
        $cache->setLifeTime('86400');
        $data = $cache->call( array($this, 'loadData') );
        return $data;
    }
    
    /**
     * Loads the data from the database
     */
    public function loadData()
    {  
       // TODO Loading the component with the helper doesn't work because everything is protected so we can't loop it
       // also this is useful because we now now the component ID, and the option, and enabled status of a component
       // $data = JComponentHelper::getParams('com_locator');
       // 
        $option = 'com_locator';
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        $query->select('extension_id AS "id", element AS "option", params, enabled');
        $query->from('#__extensions');
        $query->where('`type` = '.$db->quote('component'));
        $query->where('`element` = '.$db->quote($option));
        $db->setQuery($query);

        $result = $db->loadObject();

        $data = json_decode($result->params);
        $data->id = $result->id;
        $data->option = $result->option;
        $data->enabled = $result->enabled;
        return $data;
    }
    
    /**
     * Set Variables
     *
     * @acces   public
     * @return  object
     */
    public function setVariables() 
    {
        $success = false;
        
        
        $data = $this->getData();
        
        if ( !empty($data) )
        {
            
            foreach($data as $title => $value) {
                if (!empty($title)) {
                    $this->$title = $value;
                }
            }

            $success = true;
        }

        return $success;
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
            $instance = new Locator();
        }
    
        return $instance;
    }
    
    /**
     * Intelligently loads instances of classes in framework
     *
     * Usage: $object = Locator::getClass( 'LocatorHelperCarts', 'helpers.carts' );
     * Usage: $suffix = Locator::getClass( 'LocatorHelperCarts', 'helpers.carts' )->getSuffix();
     * Usage: $categories = Locator::getClass( 'LocatorSelect', 'select' )->category( $selected );
     *
     * @param string $classname   The class name
     * @param string $filepath    The filepath ( dot notation )
     * @param array  $options
     * @return object of requested class (if possible), else a new JObject
     */
    public static function getClass( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_locator' )  )
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
    public static function load( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_locator' ) )
    {
        return parent::load( $classname, $filepath, $options  );
    }
}
?>
