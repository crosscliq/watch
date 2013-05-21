<?php 

defined('_JEXEC') or die('Restricted access');


class LocatorSelect extends DSCSelect
{
	
	public static function getCategories() {
		JTable::addIncludePath( JPATH_ADMINISTRATOR .'/components/com_categories/tables' );
		JModel::addIncludePath( JPATH_ADMINISTRATOR .'/components/com_categories/models' );
		$model = JModel::getInstance('categories','CategoriesModel');
		$model->setState('list.select','a.id, a.title, a.alias, a.note, a.published, a.params');
		$app	= JFactory::getApplication();
		$app -> setUserState('com_categories.categories.filter.extension', 'com_locator');
		$items = $model -> getItems();
		return $items;
	}

	public static function getSCategoriesSelectList($selected, $name = 'filter_categories', $attribs = array('class' => 'inputbox'), $idtag = null, $allowAny = false, $title = 'Select Category') {

		$items = LocatorSelect::getCategories();
		$list = array();
		if ($allowAny) {
			$list[] = DSCSelect::option('', "- " . JText::_($title) . " -");
		}
		foreach ($items as $item) {
			$list[] = JHTML::_('select.option', $item -> id, $item -> title);

		}

		return DSCSelect::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag);
	}
	
	
}