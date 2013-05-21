<?php 
$items = $this->items;
$dom = new DOMDocument("1.0");
$node = $dom -> createElement("markers");
$parnode = $dom -> appendChild($node);	
// Iterate through the rows, adding XML nodes for each
foreach($items as $row){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row->name);
  $newnode->setAttribute("title", $row->title);
  $newnode->setAttribute("street", $row->street);
  $newnode->setAttribute("street2", $row->street2);	
  $newnode->setAttribute("zip", $row->zip);
  $newnode->setAttribute("state", $row->state);
  $newnode->setAttribute("country", $row->country);
  $newnode->setAttribute("phone", $row->phone);	
  $newnode->setAttribute("lat", $row->latitude);
  $newnode->setAttribute("lng", $row->longitude);
  $newnode->setAttribute("type", $row->type);	
  $newnode->setAttribute("pin", $row->pin);  
  $newnode->setAttribute("directions", $row->directions);
  $newnode->setAttribute("distance", $row->distance);
}
echo $dom->saveXML();
?>