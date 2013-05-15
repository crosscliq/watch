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

class MediaManagerModelMediaFiles extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_title    = $this->getState('filter_title');
        $filter_enabled = $this->getState('filter_enabled');
        $filter_file = $this->getState('filter_file');
        $filter_media = $this->getState('filter_media');
        $filter_filename = $this->getState('filter_filename'); 

        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.mediafile_id) LIKE '.$key;
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
        
        if (strlen($filter_filename))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_filename ) ) ).'%');
            $query->where('LOWER(file.file_name) LIKE '.$key);
        }

        if (strlen($filter_file))
        {
            $query->where('tbl.file_id = '.$this->_db->Quote($filter_file));
        }

        if (strlen($filter_media))
        {
            $query->where('tbl.media_id = '.$this->_db->Quote($filter_media));
        }
    }
    
    protected function _buildQueryJoins(&$query)
    {
        $query->join('LEFT', '#__mediamanager_media AS media ON tbl.media_id = media.media_id');
        $query->join('LEFT', '#__mediamanager_files AS file ON tbl.file_id = file.file_id');
    }
    
    protected function _buildQueryFields(&$query)
    {
        $fields = array();
        $fields[] = " file.* ";
        $fields[] = " media.* ";
        
        $query->select( $this->getState( 'select', 'tbl.*' ) );     
        $query->select( $fields );
    }
}