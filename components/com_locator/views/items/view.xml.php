<?php
/**
 * @version	1.5
 * @package	Locator
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

//Locator::load('LocatorViewBase', 'views.base', array('site' => 'site', 'type' => 'components', 'ext' => 'com_locator'));

class LocatorViewItems extends DSCViewSite {

  function display($tpl = null) {
  $model = $this->getModel( $this->get( 'suffix' ) );
  $items = $model->getList();

    $dom = new DOMDocument("1.0");
    $node = $dom -> createElement("markers");
    $parnode = $dom -> appendChild($node);  
// Iterate through the rows, adding XML nodes for each
foreach($items as $row){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row->name);
  $newnode->setAttribute("street", $row->street);
  $newnode->setAttribute("street2", $row->street2); 
  $newnode->setAttribute("zip", $row->zip);
  $newnode->setAttribute("state", $row->state);
$newnode->setAttribute("country", $row->country);
  $newnode->setAttribute("phone", $row->phone); 
  $newnode->setAttribute("lat", $row->latitude);
  $newnode->setAttribute("lng", $row->longitude);
  $newnode->setAttribute("type", $row->type); 
  $newnode->setAttribute("directions", $row->directions);
  $newnode->setAttribute("distance", $row->distance);
}
echo $dom->saveXML();
  }}