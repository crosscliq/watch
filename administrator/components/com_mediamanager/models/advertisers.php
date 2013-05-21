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

class MediaManagerModelAdvertisers extends MediaManagerModelBase
{ 
	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		

		if ( strlen( $filter ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			$where = array( );
			$where[] = 'LOWER(tbl.advertiser_name) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
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
	//	$query->join( "LEFT", "#__mediamanager_stationtypes AS ct ON ct.stationtype_id = tbl.stationtype_id" );
	}

	protected function prepareItem(&$item, $key = 0, $refresh = false) {
    $item -> id = $item -> advertiser_id;
    
    $item->link = 'index.php?option=com_mediamanager&view=advertisers&task=edit&id=' . $item->advertiser_id;

    parent::prepareItem($item, $key, $refresh);

 	 }
	




}