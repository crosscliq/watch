<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC')or die('Restricted Access'); 

MediaManager::load('MediaManagerModelBase','models._base'); 

class MediaManagerModelStation extends MediaManagerModelBase
{ 

	var $_uuid = null;

	function getTable( $name = 'Stations', $prefix = 'MediaManagerTable', $options = array( ) )
    {
        return parent::getTable( $name, $prefix, $options );
    }



	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		$filter_stationtype = $this->getState( 'filter_stationtype' );
		$filter_uuid = $this->getState( 'filter_uuid' );

		if ( strlen( $filter ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			$where = array( );
			$where[] = 'LOWER(tbl.station_name) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
		
		if ( strlen( $filter_stationtype ) )
		{
			$query->where( 'tbl.stationtype_id = ' . $this->_db->Quote( $filter_stationtype ) );
		}

		if ( strlen( $filter_uuid ) )
		{
			$query->where( 'tbl.uuid = ' . $this->_db->Quote( $filter_uuid ) );
		}
	}
	
	/**
	 * Builds SELECT fields list for the query
	 */
	protected function _buildQueryFields( &$query )
	{
		$query->select( $this->getState( 'select', 'tbl.*' ) );

	}
	/**
	 * Builds JOINS clauses for the query
	 */
	protected function _buildQueryJoins( &$query )
	{
		//$query->join( "LEFT", "#__mediamanager_stationtypes AS ct ON ct.stationtype_id = tbl.stationtype_id" );
	}

	protected function prepareItem(&$item, $key = 0, $refresh = false) {
    $item -> id = $item -> station_id;
    
    $item->link = 'index.php?option=com_mediamanager&view=stations&task=edit&id=' . $item->station_id;
    $item->media = $this->addMedia($item->media_id);
    parent::prepareItem($item, $key, $refresh);

 	 }


 	 function addMedia($pk) {
 	 	MediaManager::load('MediaManagerModelMedia','models.media');
 	 	$model = JModel::getInstance('Media','MediaManagerModel');
 	 	$model->setState( 'get_categories', true );
 	 	$media = $model->getItem($pk);

 	 	return $media;
 	 }

 	 /**
	 * Gets the identifier, setting it if it doesn't exist
	 * @return unknown_type
	 */
	public function getUUID()
	{
		if (empty($this->_uuid))
		{
			$this->_uuid = JRequest::getVar( 'uuid', JRequest::getVar( 'uuid', '0', 'post', 'int' ), 'get', 'int' );

		}

		return $this->_uuid;
	}

	/**
	 * Gets an item for displaying (as opposed to saving, which requires a JTable object)
	 * using the query from the model and the tbl's unique identifier
	 *
	 * @return database->loadObject() record
	 */
	public function getItembyUUID( $pk=null, $refresh=false, $emptyState=true )
	{
	    if (empty($this->_item) || $refresh)
	    {
	        if (is_bool($pk)) {
	            // backwards compatibility
	            $refresh = $pk;
	            $pk = null;
	        }
	        $cache_key = $pk ? $pk : $this->getUUID();
	    
	        $classname = strtolower( get_class($this) );
	        $cache = JFactory::getCache( $classname . '.item', '' );
	        $cache->setCaching($this->cache_enabled);
	        $cache->setLifeTime($this->cache_lifetime);
	        $item = $cache->get($cache_key);
			if(!version_compare(JVERSION,'1.6.0','ge'))
			{
				$item = unserialize( trim( $item ) );
			}			
	        if (!$item || $refresh)
	        {
	            if ($emptyState)
	            {
	                $this->emptyState();
	            }
	            
    			$query = $this->getQuery( $refresh );

    			$keyname = 'uuid';
    			$value	= $this->_db->Quote( $cache_key );
    			$query->where( "tbl.$keyname = $value" );
    			
    			$this->_db->setQuery( (string) $query );
    			
    			$item = $this->_db->loadObject();
    			
	            if (!empty($item))
	            {
	                $this->prepareItem( $item, 0, $refresh );
	            }
	    
				if(version_compare(JVERSION,'1.6.0','ge'))
				{
					// joomla! 1.6+ code here
					$cache->store($item, $cache_key);
				}
				else
				{
					// Joomla! 1.5 code here
					$cache->store(  serialize( $item ), $cache_key);
				}
	        }
	    
	        $this->_item = $item;
	    
	    }
		
		return $this->_item;
	}

	




}