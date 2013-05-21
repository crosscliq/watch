var ll, markers, scrollpane, mapOptions;
var gMarkers = [];
var letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
var mileage = 1;
var zooms = [14, 13, 10, 9];

jQuery(document).ready(function() {

	var pinImage = 'media/com_locator/images/map/bg_pin_';
	scrollpane = jQuery('.map_results_holder').jScrollPane();

	ll = new google.maps.LatLng(37.09024, -95.712891);
	mapOptions = {
		center : ll,
		zoom : 4,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);

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
		var st = jQuery(this).val();
		var sp = st.search(' ');
		mileage = st.slice(0, sp);
	});

	function handleQuery() {
		searchLocations();
	}

	function buildMap(latlon) {
		u = '/index.php?option=com_locator&view=items&format=xml&tmpl=raw&lat=' + latlon.lat() + '&lng=' + latlon.lng() + '&filter_radius=' + mileage
		
		console.log(u);
		jQuery.ajax({
			type : "GET",
			url : u,
			dataType : "xml",
			success : function(xml) {
				markers = jQuery(xml).find('marker');
				console.log(markers);
				jQuery("ul.map_results_holder div.jspPane li").remove();

				for (var i = 0; i < gMarkers.length; i++) {
					gMarkers[i].setMap(null);
				}
				gMarkers = [];

				//ll = new google.maps.LatLng( parseFloat( jQuery(markers[0]).attr('lat') ), parseFloat( jQuery(markers[0]).attr('lng') ) );
				if (markers.length > 0)
					ll = new google.maps.LatLng(parseFloat(jQuery(markers[0]).attr('lat')), parseFloat(jQuery(markers[0]).attr('lng')));
				else
					ll = new google.maps.LatLng(parseFloat(latlon.Xa), parseFloat(latlon.Ya));

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

				for (var i = 0; i < markers.length; i++) {

					ll = new google.maps.LatLng(parseFloat(jQuery(markers[i]).attr('lat')), parseFloat(jQuery(markers[i]).attr('lng')));
					var lr = getLetter(i);
					var nm = new google.maps.Marker({
						position : ll,
						map : map,
						animation : google.maps.Animation.DROP,
						title : "",
						icon : pinImage + lr + '.png'
					});

					gMarkers.push(nm);

					if (jQuery(markers[i]).attr('phone')) {
						jQuery("ul.map_results_holder div.jspPane").append('<li><div class="map_result_content_left"><img class="map_pin" alt="map pin" src="' + pinImage + lr + '.png" /><img class="map_star" alt="star" src="/media/com_locator/images/map/star.gif" /></div><div class="map_result_content_right"><span><h1 style="float:left; margin-right:8px;">' + jQuery(markers[i]).attr('name') + '</h1><img class="" alt="triangle" src="/media/com_locator/images/map/bg_triangle.png" /></span><p>' + jQuery(markers[i]).attr('street') + ' ' + jQuery(markers[i]).attr('state') + ', ' + jQuery(markers[i]).attr('zip') + '</p><p>' + jQuery(markers[i]).attr('phone') + '</p><p><a href="' + jQuery(markers[i]).attr('directions') + '">Get Directions</a></p></div></li>');
					} else {
						jQuery("ul.map_results_holder div.jspPane").append('<li><div class="map_result_content_left"><img class="map_pin" alt="map pin" src="' + pinImage + lr + '.png" /><img class="map_star" alt="star" src="/media/com_locator/images/map/star.gif" /></div><div class="map_result_content_right"><span><h1 style="float:left; margin-right:8px;">' + jQuery(markers[i]).attr('name') + '</h1><img class="" alt="triangle" src="/media/com_locator/images/map/bg_triangle.png" /></span><p>' + jQuery(markers[i]).attr('street') + ' ' + jQuery(markers[i]).attr('state') + ', ' + jQuery(markers[i]).attr('zip') + '</p><p><a href="' + jQuery(markers[i]).attr('directions') + '">Get Directions</a></p></div></li>');

					}

				}

				jQuery(scrollpane).data('jsp').reinitialise();
			}
		});

	}

	function searchLocations() {
		var address = document.getElementById("findStoreInput").value;

		var geocoder = new google.maps.Geocoder();

		var res;

		geocoder.geocode({
			address : address
		}, function(results, status) {

			if (status == google.maps.GeocoderStatus.OK) {

				buildMap(results[0].geometry.location);
				//console.log( results[0].geometry.location);
			} else {
				alert(address + ' not found');
			}

		});
	}

	//setTimeout(buildMap, 6000)
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

