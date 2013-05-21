
    <link rel="stylesheet" href="<?php echo $this->baseurl ; ?>/media/com_locator/css/site.css">
    <link rel="stylesheet" href="<?php echo $this->baseurl ; ?>/media/com_locator/css/jquery.jscrollpane.css">

<?php 
$doc = JFactory::getDocument();
$doc->addScript("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
$doc->addStyleSheet($this->baseurl .'/media/com_locator/css/site.css');
$doc->addStyleSheet($this->baseurl .'/media/com_locator/css/jquery.jscrollpane.css');
$doc->addScript("http://maps.googleapis.com/maps/api/js?key=AIzaSyDCwHbFU0lwIzkObOUEm9grsqfoeQJ3K18&sensor=true");
$doc->addScript($this->baseurl."/media/com_locator/js/libs/jquery.jscrollpane.min.js");
$doc->addScript($this->baseurl."/media/com_locator/js/map.js");



?>

  
  
      
    <div id="mapCanvas" class="map_canvas">
    </div>
            <div class="map_results">

                <ul class="map_results_holder">
                    
                </ul>
                        <div class="map_results_form">
                            
                                    <form action="" method="post">
                                        <input id="findStoreInput" class="find_store_input" type="text" name="find_store" value="<?php echo JRequest::getVar('find_store', '84101'); ?>" />
                                        <button id="findNowBtn" class="btn btn-primary">AJAX </button>
                                       
                                    <select name="filterByDistance_input" id="filterByDistance_input" class="dropdown">
                                      <option value="1">1 MILE</option>
                                      <option value="2">2 MILES</option>
                                      <option value="3">3 MILES</option>
                                      <option value="4">4 MILES</option>
                                      <option value="5">5 MILES</option>
                                    </select>
                                    </form>
                                    
                    
                      </div>
            </div>
    
<hr>
    <?php 
    ?>


    <div class="connections"> 
        <div id="JSON" style="text-align:left;">
            <h1>JSON</h1>
            <pre><?php echo JURI::base(). 'index.php?option=com_locator&view=items&format=json&tmpl=raw&lat=40.7563925&lng=-111.8985922&filter_radius=20'; ?></pre>
        </div>
        <hr>
        <div id="xml" style="text-align:left;">
            <h1>XML</h1>
            <pre><?php echo JURI::base(). 'index.php?option=com_locator&view=items&format=xml&tmpl=raw&lat=40.7563925&lng=-111.8985922&filter_radius=20'; ?></pre>
        </div>
    </div>    

    <div style="text-align:left;">
         <hr>
        <h1>DOCS</h1>
        <ul>
            <li>Server uses Lat and long posts  to return radius results, you can gather lat and long like the example using google maps API, or using the HTML5 Geolocation API and postiing those results</li>
            <li></li>
            <li></li>
            <li></li>
        </ul>    
    </div>