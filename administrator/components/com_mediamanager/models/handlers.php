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
defined('_JEXEC') or die('Restricted access');

MediaManager::load( 'MediaManagerModelBase', 'models._base' );

class MediaManagerModelHandlers extends MediaManagerModelBase 
{
    function getTable($name='Plugins', $prefix='MediaManagerTable', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }
    
    protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
        $filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
        $filter_name    = $this->getState('filter_name');
        $filter_type    = $this->getState('filter_type');
        $filter_element    = $this->getState('filter_element');
        
        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

            $where = array();
            $where[] = 'LOWER(tbl.id) LIKE '.$key;
            $where[] = 'LOWER(tbl.name) LIKE '.$key;
            $where[] = 'LOWER(tbl.element) LIKE '.$key;
            
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.id >= '.(int) $filter_id_from);
            }
                else
            {
                $query->where('tbl.id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.id <= '.(int) $filter_id_to);
        }
        
        if (strlen($filter_name)) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_name ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(tbl.name) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if (strlen($filter_element)) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_element ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(tbl.element) LIKE '.$key;
            $query->where('('.implode(' OR ', $where).')');
        }
        
        if(version_compare(JVERSION,'1.6.0','ge')) {
            $query->where("LOWER(tbl.type) = 'plugin'");
        }
        
        $query->where("LOWER(tbl.folder) = 'mediamanager'");
        
        if (strlen($filter_type))
        {
            $query->where("tbl.element LIKE '". $filter_type . "_%'");
        } 
            else
        {
            $where = array();
            
            $groups = $this->getGroups();
            foreach ($groups as $group)
            {
                $key    = $group . "_%";
                $where[] = "tbl.element LIKE '$key'";
            }
            //$key1    = 'slideshow_%';
            //$key2    = 'video_%';
            //$key3    = 'audio_%';
            //$key4    = 'image_%';
            
            $query->where('('.implode(' OR ', $where).')');
        }
    }
    
    public function getList( $refresh=false )
    {
        $list = parent::getList( $refresh );
        $key = $this->getTable()->getKeyName();
        foreach($list as $item)
        {
            $item->link = 'index.php?option=com_mediamanager&view=tools&task=view&id='.$item->$key;
            $item->link_add = 'index.php?option=com_mediamanager&view=media&task=add&handler=' . $item->element;
        }
        return $list;
    }
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function getGroups()
	{
	    $groups_list = MediaManager::getInstance()->get( 'groups' );
	    $groups_array = explode( "\n", $groups_list );

	    $groups = array('slideshow', 'video', 'audio');
	    foreach ($groups_array as $group)
	    {
	        $group = trim( $group );
	        if (!empty($group) && !in_array( $group, $groups ) )
	        {
	            $groups[] = $group;
	        }
	    }
	    
	    return $groups;
	}
}
