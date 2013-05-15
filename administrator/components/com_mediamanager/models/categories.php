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

class MediaManagerModelCategories extends MediaManagerModelBase
{ 
	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		$filter_categorytype = $this->getState( 'filter_categorytype' );
		
		if ( strlen( $filter ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			$where = array( );
			$where[] = 'LOWER(tbl.category_title) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
		
		if ( strlen( $filter_categorytype ) )
		{
			$query->where( 'tbl.categorytype_id = ' . $this->_db->Quote( $filter_categorytype ) );
		}
	}
	
	/**
	 * Builds SELECT fields list for the query
	 */
	protected function _buildQueryFields( &$query )
	{
		$query->select( $this->getState( 'select', 'tbl.*' ) );
		$query->select( "ct.*" );
	}
	
	/**
	 * Builds JOINS clauses for the query
	 */
	protected function _buildQueryJoins( &$query )
	{
		$query->join( "LEFT", "#__mediamanager_categorytypes AS ct ON ct.categorytype_id = tbl.categorytype_id" );
	}
	
	public function getList( $refresh = false )
	{
		$list = parent::getList( $refresh );
		
		foreach ( $list as $item )
		{
			$item->link = 'index.php?option=com_mediamanager&view=categories&task=edit&id=' . $item->category_id;
		}
		return $list;
	}
}