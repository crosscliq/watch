<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this tag is being included by a parent tag */
defined('_JEXEC')or die('Restricted Access'); 

MediaManager::load('MediaManagerModelBase','models._base'); 

class MediaManagerModelMediaTags extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_title    = $this->getState('filter_title');
        $filter_tag = $this->getState('filter_tag');
        $filter_media = $this->getState('filter_media');

        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.mediatag_id) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.mediatag_id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.mediatag_id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.mediatag_id <= '.(int) $filter_id_to);
        }
        
        if (strlen($filter_title))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_title ) ) ).'%');
            $query->where('LOWER(tag.tag_title) LIKE '.$key);
        }

        if (strlen($filter_tag))
        {
            $query->where('tbl.tag_id = '.$this->_db->Quote($filter_tag));
        }

        if (strlen($filter_media))
        {
            $query->where('tbl.media_id = '.$this->_db->Quote($filter_media));
        }
    }
    
    protected function _buildQueryJoins(&$query)
    {
        $query->join('LEFT', '#__mediamanager_media AS media ON tbl.media_id = media.media_id');
        $query->join('LEFT', '#__mediamanager_tags AS tag ON tbl.tag_id = tag.tag_id');
    }
    
    protected function _buildQueryFields(&$query)
    {
        $fields = array();
        $fields[] = " tag.* ";
        $fields[] = " media.* ";
        
        $query->select( $this->getState( 'select', 'tbl.*' ) );     
        $query->select( $fields );
    }
}