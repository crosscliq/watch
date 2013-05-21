<?php
/**
 * @version 1.5
 * @package Locator
 * @author  Dioscouri Design
 * @link  http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Locator::load('LocatorModelBase', 'models.base');

class LocatorModelItems extends LocatorModelBase {
  function getTable($name = 'items', $prefix = 'LocatorTable', $options = array()) {
    return parent::getTable($name, $prefix, $options);
  }

  protected function _buildQueryWhere(&$query) {
    $filter = $this -> getState('filter');
    $filter_name = $this -> getState('filter_name');
    $filter_description = $this -> getState('filter_description');
    $filter_id_from = $this -> getState('filter_id_from');
    $filter_id_to = $this -> getState('filter_id_to');
    $filter_cat_id = $this -> getState('filter_cat_id');
    $filter_user_id = $this -> getState('filter_user_id');
    $filter_street = $this -> getState('filter_street');
    $filter_street2 = $this -> getState('filter_street2');
    $filter_city = $this -> getState('filter_city');
    $filter_state = $this -> getState('filter_state');
    $filter_zip = $this -> getState('filter_zip');
    $filter_country = $this -> getState('filter_country');
    $filter_phone = $this -> getState('filter_phone');
    $filter_type = $this -> getState('filter_type');
    $lat = $this -> getState('lat');
    $lng = $this -> getState('lng');
    $filter_radius = $this -> getState('filter_radius');
    $filter_distance = $this -> getState('filter_distance');
    $filter_notes = $this -> getState('filter_notes');

    $filter_datecreated = $this -> getState('filter_datecreated');
    $filter_datemodified = $this -> getState('filter_datemodified');
    $filter_enabled = $this -> getState('filter_enabled');

    if ($filter) {
      $key = $this -> _db -> Quote('%' . $this -> _db -> escape(trim(strtolower($filter))) . '%');
      $where = array();
      $where[] = 'LOWER(tbl.item_id) LIKE ' . $key;
      $where[] = 'LOWER(tbl.name) LIKE ' . $key;
      $where[] = 'LOWER(tbl.description) LIKE ' . $key;
      $where[] = 'LOWER(tbl.street) LIKE ' . $key;
      $where[] = 'LOWER(tbl.city) LIKE ' . $key;
      $where[] = 'LOWER(tbl.state) LIKE ' . $key;

      $query -> where('(' . implode(' OR ', $where) . ')');
    }
    if ($filter_name) {
    
      $key = $this -> _db -> Quote('%' . $this -> _db -> escape(trim(strtolower($filter_name))) . '%');

      $where = array();
      $where[] = 'LOWER(tbl.item_id) LIKE ' . $key;
      $where[] = 'LOWER(tbl.name) LIKE ' . $key;

      $query -> where('(' . implode(' OR ', $where) . ')');
    }

    if (strlen($filter_id_from)) {
      if (strlen($filter_id_to)) {
        $query -> where('tbl.item_id >= ' . (int)$filter_id_from);
      } else {
        $query -> where('tbl.item_id = ' . (int)$filter_id_from);
      }
    }

    if (strlen($filter_id_to)) {
      $query -> where('tbl.item_id <= ' . (int)$filter_id_to);
    }

    if (strlen($filter_datecreated)) {
      $query -> where("tbl.datecreated = '" . $filter_datecreated . "'");
    }
    if (strlen($filter_datemodified)) {
      $query -> where("tbl.datemodified = '" . $filter_datemodified . "'");
    }

    if (strlen($filter_enabled)) {
      $query -> where("tbl.enabled = '" . $filter_enabled . "'");
    }

    if (strlen($lat) && strlen($lng) && strlen($filter_radius)) {
      $query -> having(" distance < '" . $filter_radius . "'");
    }

  
  }

  protected function _buildQueryGroup(&$query) {
  }

  /**
   * Builds JOINS clauses for the query
   */
  protected function _buildQueryJoins(&$query) {
    //   $query -> join('LEFT', '#__management_extensions AS e ON  e.ext_id = tbl.ext_id ');

  }

  /**
   * Builds SELECT fields list for the query
   */
  protected function _buildQueryFields(&$query) {
    $fields = array();
    $distance = $this -> _buildQueryFieldsRadiusSelect();
    if (strlen($distance)) {
      $fields = $distance;
    }

    $query -> select($this -> getState('select', 'tbl.*'));
    $query -> select($fields);

  }

  protected function _buildQueryFieldsRadiusSelect() {
    /* query idea taken from https://developers.google.com/maps/articles/phpsqlsearch_v3#findnearsql */
    $radius = $this -> getState('filter_radius');
    $lat = $this -> getState('lat');
    $lng = $this -> getState('lng');
    $distance = $this -> getState('filter_distance');
    if ($radius && $lat && $lng || $distance && $lat && $lng) {

      return "( 3959 * acos( cos( radians('{$lat}') ) * cos( radians( tbl.latitude ) ) * cos( radians( tbl.longitude ) - radians('{$lng}') ) + sin( radians('{$lat}') ) * sin( radians( tbl.latitude ) ) ) ) AS distance ";
    }

  }

  protected function prepareItem(&$item, $key = 0, $refresh = false) {
    $item -> id = $item -> item_id;
    $item -> link = 'index.php?option=com_locator&view=items&task=edit&id=' . $item -> id;
    $item -> edit_link = 'index.php?option=com_locator&task=edit&tmpl=component&layout=form&id=' . $item -> id;

    //TODO Move this to a onPrepareItem plugin so the model isn't tied to google
    $item -> name = strtoupper(preg_replace('/[^\\/\-a-z\s]/i', '', $item -> name));
    //TODO  actually do this in the database so it is faster
    $item -> directions = 'https://maps.google.com/?daddr=' . $item -> latitude . ',' . $item -> longitude;

    parent::prepareItem($item, $key, $refresh);

  }

}
