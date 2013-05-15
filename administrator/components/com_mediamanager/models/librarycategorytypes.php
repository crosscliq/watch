<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this category is being included by a parent category */
defined('_JEXEC')or die('Restricted Access'); 

MediaManager::load('MediaManagerModelBase','models._base'); 

class MediaManagerModelLibraryCategoryTypes extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_enabled = $this->getState('filter_enabled');
        $filter_category = $this->getState('filter_category');
        $filter_library = $this->getState('filter_library');
        $filter_categorytype = $this->getState('filter_categorytype'); 

        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.librarycategorytype_id) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.librarycategorytype_id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.librarycategorytype_id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.librarycategorytype_id <= '.(int) $filter_id_to);
        }

        if (strlen($filter_categorytype))
        {
            $query->where('tbl.categorytype_id = '.$this->_db->Quote($filter_categorytype));
        }

        if (strlen($filter_library))
        {
            $query->where('tbl.library_id = '.$this->_db->Quote($filter_library));
        }
    }
    
    protected function _buildQueryJoins(&$query)
    {
        $query->join('LEFT', '#__mediamanager_libraries AS lib ON tbl.library_id = lib.library_id');
        $query->join('LEFT', '#__mediamanager_categorytypes AS ct ON tbl.categorytype_id = ct.categorytype_id');
    }
    
    protected function _buildQueryFields(&$query)
    {
        $fields = array();
        $fields[] = " ct.* ";
        $fields[] = " lib.* ";
        
        $query->select( $this->getState( 'select', 'tbl.*' ) );     
        $query->select( $fields );
    }
}