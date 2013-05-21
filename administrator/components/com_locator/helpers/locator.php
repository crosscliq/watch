<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Banners component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_locator
 * @since		1.6
 */
class LocatorHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{

	    JSubMenuHelper::addEntry(
				JText::_('COM_LOCATOR_MENU_DASHBOARD'),
				'index.php?option=com_locator&view=dashboard',
				$vName == 'locator'
			);
		JSubMenuHelper::addEntry(
			JText::_('COM_LOCATOR_MENU_ITEMS'),
			'index.php?option=com_locator&view=items',
			$vName == 'locator'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_LOCATOR_MENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_locator',
			$vName == 'categories'
		);
		if ($vName=='categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_locator')),
				'locator-categories');
		}
		JSubMenuHelper::addEntry(
			JText::_('COM_LOCATOR_MENU_CONFIG'),
			'index.php?option=com_config&view=component&component=com_locator',
			$vName == 'locator'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_locator';
			$level = 'component';
		} else {
			$assetName = 'com_locator.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_locator', $level);

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}

	
}
