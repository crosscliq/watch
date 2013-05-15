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

class MediaManagerModelSlideshowDefault extends MediaManagerModelBase
{
    protected function _buildQueryWhere(&$query)
    {
        $filter = $this->getState('filter');
        $filter_enabled = $this->getState('filter_enabled');
        $filter_media = $this->getState('filter_media');
        $filter_mediafile = $this->getState('filter_mediafile');
        $filter_published = $this->getState( 'filter_published' );
        $filter_published_date = $this->getState( 'filter_published_date' );
        
        if (strlen($filter))
        {
            $key = $this->_db->Quote('%'.$this->_db->getEscaped(trim(strtolower($filter))).'%');
            $where = array();
            $where[] = 'LOWER(tbl.caption) LIKE '.$key; 
            $where[] = 'LOWER (tbl.url) LIKE '.$key; 
            $query->where('('.implode(' OR ',$where).')');
        }
        
        if (strlen($filter_enabled))
        {
            $query->where('tbl.enabled = '.$this->_db->Quote($filter_enabled));
        }

        if (strlen($filter_media))
        {
            $query->where('tbl.media_id = '.$this->_db->Quote($filter_media));
        }

        if (strlen($filter_mediafile))
        {
            $query->where('tbl.mediafile_id = '.$this->_db->Quote($filter_mediafile));
        }
        
        if ( strlen( $filter_published ) )
        {
            $nullDate = $this->getDBO()->getNullDate();
            if (empty($filter_published_date)) {
                $date = JFactory::getDate();
                $filter_published_date = $date->toMySQL();
            }
            $query->where("(tbl.publish_up <= '" . $filter_published_date . "' AND (tbl.publish_down > '" . $filter_published_date
            . "' OR tbl.publish_down = '" . $nullDate . "' ) )", 'AND' );
        }
    }

    protected function _buildQueryJoins(&$query)
    {
        $query->join('LEFT', '#__mediamanager_mediafiles AS mediafile ON tbl.mediafile_id = mediafile.mediafile_id');
        $query->join('LEFT', '#__mediamanager_files AS file ON mediafile.file_id = file.file_id');
    }
    
    protected function _buildQueryFields(&$query)
    {
        $fields = array();
        $fields[] = " file.* ";
        $fields[] = " mediafile.* ";
        
        $query->select( $this->getState( 'select', 'tbl.*' ) );     
        $query->select( $fields );
    }
}