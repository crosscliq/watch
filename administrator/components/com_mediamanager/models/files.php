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

class MediaManagerModelFiles extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_title    = $this->getState('filter_title');
        $filter_enabled = $this->getState('filter_enabled');
        $filter_name = $this->getState('filter_name');
        $filter_urlpath = $this->getState('filter_urlpath');

        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.file_id) LIKE '.$key;
            $where[] = 'LOWER(tbl.file_title) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.file_id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.file_id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.file_id <= '.(int) $filter_id_to);
        }
        
        if (strlen($filter_title))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_title ) ) ).'%');
            $query->where('LOWER(tbl.file_title) LIKE '.$key);
        }
        
        if (strlen($filter_name))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_name ) ) ).'%');
            $query->where('LOWER(tbl.file_name) LIKE '.$key);
        }

        if (strlen($filter_enabled))
        {
            $query->where('tbl.file_enabled = '.$this->_db->Quote($filter_enabled));
        }
        
        if ($filter_urlpath)
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_urlpath ) ) ).'%');
        
            $where = array();
            $where[] = 'LOWER(tbl.file_url) LIKE '.$key;
            $where[] = 'LOWER(tbl.file_path) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
    }
    
	public function getList($refresh=false)
	{	
		$list = parent::getList($refresh); 
		foreach ($list as $item)
		{ 
			$item->link = 'index.php?option=com_mediamanager&view=files&task=edit&id='.$item->file_id;
		}
		return $list;
	}

}