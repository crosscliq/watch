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

class MediaManagerModelLibraries extends MediaManagerModelBase
{
	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		$filter_id_from = $this->getState( 'filter_id_from' );
		$filter_id_to = $this->getState( 'filter_id_to' );
		$filter_title = $this->getState( 'filter_title' );
		$filter_enabled = $this->getState( 'filter_enabled' );
		
		if ( $filter )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			
			$where = array( );
			$where[] = 'LOWER(tbl.library_id) LIKE ' . $key;
			$where[] = 'LOWER(tbl.library_title) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
		
		if ( strlen( $filter_id_from ) )
		{
			if ( strlen( $filter_id_to ) )
			{
				$query->where( 'tbl.library_id >= ' . ( int ) $filter_id_from );
			}
			else
			{
				$query->where( 'tbl.library_id = ' . ( int ) $filter_id_from );
			}
		}
		
		if ( strlen( $filter_id_to ) )
		{
			$query->where( 'tbl.library_id <= ' . ( int ) $filter_id_to );
		}
		
		if ( strlen( $filter_title ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter_title ) ) ) . '%' );
			$query->where( 'LOWER(tbl.library_title) LIKE ' . $key );
		}
		
		if ( strlen( $filter_enabled ) )
		{
			$query->where( 'tbl.library_enabled = ' . $this->_db->Quote( $filter_enabled ) );
		}
	}
	
	public function getList( $refresh = false )
	{
		$list = parent::getList( $refresh );
		foreach ( $list as $item )
		{
			$item->link = 'index.php?option=com_mediamanager&view=libraries&task=edit&id=' . $item->library_id;
			$item->link_view = 'index.php?option=com_mediamanager&view=libraries&task=view&id=' . $item->library_id;
			
			$item->params = new DSCParameter( $item->library_params);
			
			$item->groups = json_decode($item->library_groups);
			$item->categories = json_decode($item->library_categories);
		}
		return $list;
	}
	
	public function getItem( $pk=null, $refresh=false, $emptyState = false )
	{
		if ( empty( $this->_item ) || $refresh )
		{
			$item = parent::getItem( $pk, $refresh, true );
			
			$item->params = new DSCParameter( @$item->library_params );
			$item->filters = new DSCParameter( @$item->library_filters);
			$item->groups = json_decode( @$item->library_groups );
			$item->categories = json_decode( @$item->library_categories );
			
			$lcmodel = JModel::getInstance('LibraryCategories', 'MediaManagerModel');
			$item->librarycategories = array();
			if ( !empty( $item->library_id ) && $this->getState('get_categories'))
			{
			    $lcmodel->setState('filter_library', $item->library_id);
			    $item->librarycategories = $lcmodel->getList(true);
			}
			
			$this->_item = $item;
		}
		
		return $this->_item;
	}
	
	public function typeEnabled( $type_id, $lib_id='' )
	{
	    if (empty($lib_id))
	    {
	        return false;
	    }
	    
	    $table = $this->getTable('LibraryCategoryTypes');
	    $table->load( array( 'library_id'=>$lib_id, 'categorytype_id'=>$type_id ) );
	    if (!empty($table->librarycategorytype_id))
	    {
	        return true;
	    }
	    
	    return false;
	}
}
