<?php
header('Access-Control-Allow-Origin: *');
$view = JRequest::getWord('view');
$task = JRequest::getWord('task');

$db = JFactory::getDBO();
$jnow = JFactory::getDate();
$now = $jnow -> toSql();
$nullDate = $db -> getNullDate();

$model = $this -> getModel($this -> get('suffix'));

$items = $model -> getList();

// Output
$response = new stdClass();

// Site
//$response -> site = new stdClass();
//$uri = JURI::getInstance();
//$response -> site -> url = $uri -> toString(array('scheme', 'host', 'port'));
//$config = JFactory::getConfig();
//$response -> site -> name = $config -> getValue('config.sitename');

$response -> location = $items;

$json = json_encode($response);
$callback = JRequest::getCmd('callback');
if ($callback) {
	$document -> setMimeEncoding('application/javascript');
	echo $callback . '(' . $json . ')';
} else {
	echo $json;
}
?>
