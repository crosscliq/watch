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
defined( '_JEXEC' ) or die( 'Restricted Access' );

MediaManager::load( 'MediaManagerModelBase', 'models._base' );

class MediaManagerModelMedia extends MediaManagerModelBase
{
	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		$filter_media = $this->getState( 'filter_media' );
		$filter_enabled = $this->getState( 'filter_enabled' );
		$filter_mediatype = $this->getState( 'filter_mediatype' );
		$filter_category_values = $this->getState( 'filter_category_values' );
		$filter_categories = $this->getState( 'filter_categories' );
		$filter_librarycategories = $this->getState( 'filter_librarycategories' );
		$filter_groups = $this->getState( 'filter_groups' );
		$filter_librarygroups = $this->getState( 'filter_librarygroups' );
		$filter_secondary_category = $this->getState( 'filter_secondary_category' );
		$filter_tag = $this->getState( 'filter_tag' );
		
		if ( strlen( $filter ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			$where = array( );
			$where[] = 'LOWER(tbl.media_title) LIKE ' . $key;
			$where[] = 'LOWER(tbl.media_title_long) LIKE ' . $key;
			$where[] = 'LOWER (tbl.media_description) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
		
		if ( strlen( $filter_media ) )
		{
			$key = $this->_db->Quote( $this->_db->getEscaped( trim( strtolower( $filter_media ) ) ) );
			$query->where( 'tbl.media_type = ' . $key ); // this should be media_id, no?
		}
		
		if ( strlen( $filter_enabled ) )
		{
			$query->where( 'tbl.media_enabled = ' . $this->_db->Quote( $filter_enabled ) );
		}
		
		if ( strlen( $filter_mediatype ) )
		{
			$query->where( 'tbl.media_type = ' . $this->_db->Quote( $filter_mediatype ) );
		}
		
		if ( !empty( $filter_category_values ) && is_array( $filter_category_values ) )
		{
			$where = array( );
			foreach ( $filter_category_values as $value )
			{
				$key = $this->_db->Quote( $this->_db->getEscaped( trim( strtolower( $value ) ) ) );
				$where[] = 'LOWER (mediacats.value) LIKE ' . $key;
			}
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
		
		if ( !empty( $filter_categories ) && is_array( $filter_categories ) )
		{
		    $categories = array();
		    foreach ($filter_categories as $cat)
		    {
		        if (!empty($cat)) { $categories[] = $cat; }
		    }
			$query->where( "mediacats.category_id IN ('" . implode( "', '", $categories) . "')" );
		}
		
		if ( !empty( $filter_librarycategories ) && is_array( $filter_librarycategories ) )
		{
		    $categories = array();
		    foreach ($filter_librarycategories as $cat)
		    {
		        if (!empty($cat)) {
		            $categories[] = $cat;
		        }
		    }
		    $query->where( "mediacats.category_id IN ('" . implode( "', '", $categories) . "')" );
		}
		
		if ( !empty( $filter_groups ) && is_array( $filter_groups ) )
		{
		    $query->where( "tbl.media_group IN ('" . implode( "', '", $filter_groups) . "')" );
		}
		
		if ( !empty( $filter_librarygroups ) && is_array( $filter_librarygroups ) )
		{
		    $query->where( "tbl.media_group IN ('" . implode( "', '", $filter_librarygroups) . "')" );
		}
		
		if (strlen($filter_secondary_category)) {
		    if ($filter_secondary_category != 'all') {
		        $query->where( "LOWER(tbl.media_type) LIKE '" . $filter_secondary_category . "_%'" );
		    }
		}

		if ( strlen( $filter_tag ) )
		{
			$query->where( 'tags.tag_id = ' . $this->_db->Quote( $filter_tag ) );
		}
	}
	
	protected function _buildQueryGroup( &$query )
	{
	    $query->group('media_id');
	}
	
	protected function _buildQueryJoins( &$query )
	{
		$filter_categories = $this->getState( 'filter_categories' );
		if ( !empty( $filter_categories ) && is_array( $filter_categories ) )
		{
			
		}
		$query->join( "LEFT", "#__mediamanager_mediacategories AS mediacats ON tbl.media_id = mediacats.media_id" );
		
		$filter_tag = $this->getState( 'filter_tag' );
		if ( !empty( $filter_tag ) )
		{
			$query->join( "LEFT", "#__mediamanager_mediatags AS mediatags ON tbl.media_id = mediatags.media_id" );
			$query->join( "LEFT", "#__mediamanager_tags AS tags ON mediatags.tag_id = tags.tag_id" );
		}
	}
	
	public function getList( $refresh = false )
	{
		$list = parent::getList( $refresh );
		
		foreach ( $list as $item )
		{
			$item->link = 'index.php?option=com_mediamanager&view=media&task=edit&id=' . $item->media_id;
			$item->params = new DSCParameter( $item->media_params);
			
			$types = explode('_', $item->media_type);
			$item->media_group = !empty($item->media_group) ? $item->media_group : strtolower( $types[0] );
			$item->categories = json_decode($item->media_categories);
		}
		return $list;
	}
	
	public function getItem( $pk=null, $refresh=true, $emptyState = false )
	{
		if ( empty( $this->_item ) || $refresh )
		{
			if ($item = parent::getItem( $pk, $refresh, $emptyState )) 
			{
			    $item->params = new DSCParameter( @$item->media_params );
			    	
			    JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_mediamanager'.DS.'models' );
			    $item->mediacategories = array();
			    $item->mediatags = array();
			    if ($this->getState('get_categories'))
			    {
			        if (!empty($item->media_id))
			        {
			            $mcmodel = JModel::getInstance('MediaCategories', 'MediaManagerModel');
			            $mcmodel->setState('filter_media', @$item->media_id);
			            $item->mediacategories = $mcmodel->getList(true);
			        }
			         
			        if (!empty($item->media_id))
			        {
			            $mtmodel = JModel::getInstance('MediaTags', 'MediaManagerModel');
			            $mtmodel->setState('filter_media', @$item->media_id);
			            $item->mediatags = $mtmodel->getList(true);
			        }
			    }
			    	
			    if ($this->getState('get_files'))
			    {
			        if (!empty($item->media_id))
			        {
			            $mfmodel = JModel::getInstance('MediaFiles', 'MediaManagerModel');
			            $mfmodel->setState('filter_media', $item->media_id);
			            $item->mediafiles = $mfmodel->getList(true);
			        }
			    }
			    
			    $types = explode('_', @$item->media_type);
			    $item->media_group = !empty($item->media_group) ? $item->media_group : strtolower( $types[0] );
			    $item->categories = json_decode($item->media_categories);
			    
			    $this->_item = $item;			    
			}
		}
		return $this->_item;
	}
	
	/**
	 *
	 * Enter description here ...
	 * @param $id
	 * @return unknown_type
	 */
	public function getTypes( )
	{
		// TODO Fix this, needs cleanup
		$query = "SELECT DISTINCT(`media_type`) FROM #__mediamanager_media ORDER BY 'media_type' ASC;";
		$db = $this->getDBO( );
		$db->setQuery( $query );
		$result = $db->loadObjectList( );
		return $result;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 * @param unknown_type $num
	 * @return return_type
	 */
	public function getRelated( $id, $num = '5' )
	{
	    JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$mcmodel = JModel::getInstance( 'MediaCategories', 'MediaManagerModel' );
		$mcmodel->setState('filter_media', $id );
		$mcmodel->setState('order', 'type.ordering' );
		$mcmodel->setState('direction', 'ASC' );
		$mcategories = $mcmodel->getList();

		$current_items = array();
		$remainder = $num;
		$model = JModel::getInstance( 'Media', 'MediaManagerModel' );
		foreach ($mcategories as $mcat)
		{
		    $cat = array( $mcat->category_id );
		    $model->emptyState();
		    $model->_list = array();
		    $model->_query = null;
		    $model->setState( 'filter_categories', $cat );
		    $model->setState( 'filter_enabled', '1' );
		    $model->setState( 'limit', $remainder );
    		$model->setState('order', 'tbl.date_added' );
    		$model->setState('direction', 'DESC' );
		    $query = $model->getQuery();
		    $query->where( "tbl.media_id != '$id'" );
		    
		    $media_ids = MediaManagerHelperBase::getColumn( $current_items, 'media_id' );
		    if (!empty($media_ids)) 
		    {
		        $query->where( "tbl.media_id NOT IN ( '". implode( "', '", $media_ids ) ."' )" );
		    }
		    
		    $model->setQuery( $query );
		    $items = $model->getList();
		    
		    foreach ($items as $item)
		    {
		        $current_items[] = $item;
		    }
		    
		    $current_count = count($current_items);
		    if ($current_count >= $remainder) {
		        break;
		    } else {
		        $remainder = $remainder - $current_count;
		        if ($remainder <= 0) {
		            break;
		        }
		    }
		}
		
		return $current_items;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MediaManagerModelBase::getPagination()
	 */
	function getPagination()
	{
		if (empty($this->_pagination))
		{
			MediaManager::load( 'MediaManagerPagination', 'library.pagination' );
			$this->_pagination = new MediaManagerPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit'), $this->getState('pagination.base_url') );
		}
		return $this->_pagination;
	}
	
	public function getSurrounding( $pk=null )
	{
	    $return = array();
	    $return["prev"] = '';
	    $return["next"] = '';

	    // if $pk is null, use the state from the model, where there should be a setId()
	    // if $pk is present, assume it is an eventinstance ID, get the state from the model and find the flankers

	    // get the selected item
	    if (empty($pk)) {
	        $item = $this->getItem();
	        $pk = $item->media_id;
	    }

	    // get the list of items using the rest of the state, without any pagination limits (in case this is the list item in one of the pages of paginated lists)
	    $helper = new MediaManagerHelperMedia();
	    $state = $helper->getState();
	    unset($state['limit']);
	    foreach ( $state as $key => $value )
	    {
	        $this->setState( $key, $value );
	    }
	    $list = $this->getList(true);

	    // loop through the items, looking for a match in the list against the current item,
	    // then return the items before and after
	    $count = count($list);
	    $found = false;
	    $prev_id = '';
	    $next_id = '';

	    for ($i=0; $i < $count && empty($found); $i++)
	    {
	        $row = $list[$i];
	        if ($row->media_id == $pk)
	        {
	            $found = true;
	            $prev_num = $i - 1;
	            $next_num = $i + 1;
	            if (!empty($list[$prev_num])) {
	                $prev_id = $list[$prev_num]->media_id;
	            }
	            if (!empty($list[$next_num])) {
	                $next_id = $list[$next_num]->media_id;
	            }
	        }
	    }

	    $return["prev"] = $prev_id;
	    $return["next"] = $next_id;
	    return $return;
	}
}
