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

class MediaManagerModelTags extends MediaManagerModelBase
{ 
	protected function _buildQueryWhere( &$query )
	{
		$filter = $this->getState( 'filter' );
		
		if ( strlen( $filter ) )
		{
			$key = $this->_db->Quote( '%' . $this->_db->getEscaped( trim( strtolower( $filter ) ) ) . '%' );
			$where = array( );
			$where[] = 'LOWER(tbl.tag_title) LIKE ' . $key;
			$query->where( '(' . implode( ' OR ', $where ) . ')' );
		}
	}
	
	public function getList( $refresh = false )
	{
		$list = parent::getList( $refresh );
		
		foreach ( $list as $item )
		{
			$item->link = 'index.php?option=com_mediamanager&view=tags&task=edit&id=' . $item->tag_id;
		}
		return $list;
	}
}