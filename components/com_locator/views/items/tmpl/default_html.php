<h1>JSON</h1>
<?php 

$jsonurl = "http://joomla25.local/index.php?option=com_locator&view=items&filter_radius=5&lat=27.051981&lng=-82.392509&format=json";
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json);

?>
<pre>
	<?php var_dump($json_output); ?>
</pre>
<h1>XML</h1>
<?php 

$xml = simplexml_load_file('http://joomla25.local/index.php?option=com_locator&view=items&filter_radius=5&lat=27.051981&lng=-82.392509&format=xml');
   print_r($xml);

   ?>

   <h1>HTML</h1>
   <pre>
<?php var_dump($this->items );

   ?>
</pre>