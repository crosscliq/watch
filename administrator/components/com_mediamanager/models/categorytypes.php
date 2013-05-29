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

class MediaManagerModelCategoryTypes extends MediaManagerModelBase
{ 
	public function getList( $refresh = false )
	{
		$list = parent::getList( $refresh );
		
		$cmodel = JModel::getInstance('Categories', 'MediaManagerModel');
		foreach ( $list as $item )
		{
			$item->link = 'index.php?option=com_mediamanager&view=categorytypes&task=edit&id=' . $item->categorytype_id;
			$item->categories = array();
			if ($this->getState('get_categories'))
			{
			    $cmodel->setState('filter_categorytype', $item->categorytype_id);
			    $item->categories = $cmodel->getList(true);
			}
		}
		return $list;
	}
}