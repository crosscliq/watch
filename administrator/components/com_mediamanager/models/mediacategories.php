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

class MediaManagerModelMediaCategories extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_title    = $this->getState('filter_title');
        $filter_enabled = $this->getState('filter_enabled');
        $filter_category = $this->getState('filter_category');
        $filter_media = $this->getState('filter_media');
        $filter_categorytitle = $this->getState('filter_categorytitle'); 

        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.mediacategory_id) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.mediacategory_id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.mediacategory_id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.mediacategory_id <= '.(int) $filter_id_to);
        }
        
        if (strlen($filter_categorytitle))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_categorytitle ) ) ).'%');
            $query->where('LOWER(category.category_title) LIKE '.$key);
        }

        if (strlen($filter_category))
        {
            $query->where('tbl.category_id = '.$this->_db->Quote($filter_category));
        }

        if (strlen($filter_media))
        {
            $query->where('tbl.media_id = '.$this->_db->Quote($filter_media));
        }
    }
    
    protected function _buildQueryJoins(&$query)
    {
        $query->join('LEFT', '#__mediamanager_media AS media ON tbl.media_id = media.media_id');
        $query->join('LEFT', '#__mediamanager_categories AS category ON tbl.category_id = category.category_id');
        $query->join('LEFT', '#__mediamanager_categorytypes AS type ON category.categorytype_id = type.categorytype_id');
    }
    
    protected function _buildQueryFields(&$query)
    {
        $fields = array();
        $fields[] = " category.* ";
        $fields[] = " media.* ";
        $fields[] = " type.ordering as categorytype_ordering ";
        
        $query->select( $this->getState( 'select', 'tbl.*' ) );     
        $query->select( $fields );
    }
}