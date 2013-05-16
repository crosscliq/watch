<?php 
$doc = JFactory::getDocument();
$doc->setMimeEncoding('application/javascript');

$lat = JRequest::getVar('lat', '37.09024');
$lng = JRequest::getVar('lng','-111.8985922');
$zoom = JRequest::getVar('filter_radius','1' );
?>


var ll, markers, scrollpane, mapOptions;
var gMarkers = [];
var letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
var mileage = <?php echo $zoom; ?>;
var zooms = [18, 17, 16, 15];





jQuery(document).ready(function() {

	jQuery('#filterByDistance_input').val(<?php echo $zoom ; ?>);
	ll = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);

	mapOptions = {
		center : ll,
		zoom : <?php echo $zoom; ?>,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};


	var map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
	var infoWindow = '';

	jQuery('#findNowBtn').click(function(e) {
		e.preventDefault();
		handleQuery();
	});

	jQuery('#findStoreInput').bind('keypress', function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) {
			e.preventDefault();
			handleQuery();
		}
	});

	jQuery('#filterByDistance_input').change(function() {
		mileage = jQuery(this).val();

		var zooms = [20 - mileage, 19 - mileage, 18 - mileage, 17 - mileage];
	});

	function handleQuery() {

		jQuery('#spinner').show();

		searchLocations();

	}

	function showItemSideBar(id) {
		jQuery(".map_results li").removeClass("focused");
		jQuery('#'+id).addClass('focused');
		jQuery('#'+id).focus();

		 // Scroll to the top
		jQuery('.map_results').scrollTop(0);
		jQuery('.map_results').scrollTop(jQuery('.map_results').scrollTop() + jQuery('#'+id).position().top);


    }


	function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
      //  infoWindow.setContent(html);
      //  infoWindow.open(map, marker);
        showItemSideBar(marker.id);
       	
      });
    }


	function buildMap(latlong) {
	console.log('buildingmap');
		u = 'index.php?option=com_locator&view=items&format=json&tmpl=raw&lat=' +latlong.lat + '&lng=' + latlong.lng + '&filter_radius=' + mileage
		console.log(u);
		//getting the  pins from the server
		jQuery.ajax({
			type : "GET",
			url : u,
			dataType : "json",
			cache : false,
			success : function(data) {
				markers = data.location;
		
				jQuery("ul.map_results_holder li").remove();

				for (var i = 0; i < gMarkers.length; i++) {
					gMarkers[i].setMap(null);
				}

				gMarkers = [];

				//ll = new google.maps.LatLng( parseFloat(latlong.lat), parseFloat( latlong.lng ) );
				if (markers.length > 0)
					ll = new google.maps.LatLng(parseFloat(latlong.lat), parseFloat(latlong.lng ));
				else
					ll = new google.maps.LatLng(parseFloat(latlong.lat), parseFloat(latlong.lng));

				mapOptions = {
					center : ll,
					zoom : getZoom(mileage)
				}

				map.setOptions(mapOptions);

				if (markers.length == 0) {
					jQuery("ul.map_results_holder div.jspPane").html('<div class="noResults">No results found in search radius. <br> Try new search.</div>');
					jQuery("#findStoreInput").focus();
				} else {
					jQuery("div.noResults").remove();
				}
				
					var marker = new google.maps.Marker({
						position : ll,
						map : map,
						animation : google.maps.Animation.DROP,
						title : 'center',
						
					});
					gMarkers.push(marker);

				for (var i = 0; i < markers.length; i++) {
					
					ll = new google.maps.LatLng(parseFloat(jQuery(markers[i]).attr('lat')), parseFloat(jQuery(markers[i]).attr('lng')));
				
					var marker = new google.maps.Marker({
						position : ll,
						map : map,
						animation : google.maps.Animation.DROP,
						title : jQuery(markers[i]).attr('name'),
						icon : jQuery(markers[i]).attr('pin')
					});
					var html = jQuery(markers[i]).attr('name');
					marker.set('id',jQuery(markers[i]).attr('id') );
					  bindInfoWindow(marker, map, infoWindow, html);

					gMarkers.push(marker);

					if (jQuery(markers[i]).attr('phone')) {
                   
						jQuery("ul.map_results_holder").append('<li id="'+ jQuery(markers[i]).attr('id') +'"><div class="media"><a class="pull-left" href="#"><img class="media-object" src="' + jQuery(markers[i]).attr('pin') + '"></a><div class="media-body"><h4 class="media-heading">' + jQuery(markers[i]).attr('name') + '</h4><div class="media"><div class="address">' + jQuery(markers[i]).attr('street') + ' ' + jQuery(markers[i]).attr('state') + ', ' + jQuery(markers[i]).attr('zip') + '</div><div class="phone">' + jQuery(markers[i]).attr('phone') + '</div><div class="directions"><a href="' + jQuery(markers[i]).attr('directions') + '">Get Directions</a></div></div></div></div></li>')
					} else {
						jQuery("ul.map_results_holder").append('<li id="'+ jQuery(markers[i]).attr('id') +'"><div class="media"><a class="pull-left" href="#"><img class="media-object" src="' + jQuery(markers[i]).attr('pin') + '"></a><div class="media-body"><h4 class="media-heading">' + jQuery(markers[i]).attr('name') + '</h4><div class="media"><div class="address">' + jQuery(markers[i]).attr('street') + ' ' + jQuery(markers[i]).attr('state') + ', ' + jQuery(markers[i]).attr('zip') + '</div><div class="directions"><a href="' + jQuery(markers[i]).attr('directions') + '">Get Directions</a></div></div></div></div></li>')
					}	

				}

				jQuery('#spinner').hide();
				
			}
			
		});

	}



	function searchLocations() {
		console.log('begin search');
	var address = document.getElementById("findStoreInput").value;
	console.log('after address');
		if(address) {
		console.log('yes address');
		var geocoder = new google.maps.Geocoder();
		var res;
		geocoder.geocode({
					address : address
				}, function(results, status) {

					if (status == google.maps.GeocoderStatus.OK) {

						latlong=new Object();
						latlong.lat = results[0].geometry.location.lat();
		   			    latlong.lng = results[0].geometry.location.lng();
						console.log('address geo coded');
						buildMap(latlong);
					} else {
						alert(address + ' not found');
					}

				});

				
			} else { 

			
			if (navigator.geolocation) {

			function displayPosition(position) {
					console.log('found');
					console.log(position.coords.latitude);
					latlong=new Object();
   			 		latlong.lat = position.coords.latitude;
   			 		latlong.lng = position.coords.longitude;
   			 		buildMap(latlong);

				}
			function displayError(error) {
				console.log('error');
				  var errors = { 
				    1: 'Permission denied',
				    2: 'Position unavailable',
				    3: 'Request timeout'
				  };
				  alert("Error: " + errors[error.code]);
				}	


			  var timeoutVal = 10 * 1000 * 1000;
			  navigator.geolocation.getCurrentPosition(
			    displayPosition, 
			    displayError,
			    { enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
			  );
			}
			else {
					 alert("Geolocation is not supported by this browser");
					var submit = document.getElementById('submit');    
					submit.value = "Your Location Can't be found"
			}

				

				




  	}

	}
	handleQuery();
});

function getZoom(n) {
	var rn = zooms[3];
	if (n == 5)
		rn = zooms[0];
	else if (n == 10)
		rn = zooms[1];
	else if (n == 20)
		rn = zooms[2];
	return rn;
}

function getLetter(n) {
	var rl = letters[n];
	return rl;
}

