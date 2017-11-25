<?php
// google map api function 

function map_google($ID, $API_KEY, $place_id, $place_name, $lat, $lng, $zoom, $width, $height, $marker) //zoom = 0-20;
{
	global $endclude;
	
	$markr = "";
	$place = "";
	echo "<div class='map_google' style='display:block; width:".$width."px; height:".$height."px; overflow:hidden;'><div id='".$ID."' style='width:".$width."px; height:".$height."px;'></div></div>";
	$endclude.= "<script>";
	
	if($marker)
		$markr = "var marker = new google.maps.Marker({
          position: {lat: ".$lat.", lng: ".$lng."},
          map: map
        });";
	if(!empty($place_id))
		$place = "var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
          placeId: '".$place_id."'
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            var marker = new google.maps.Marker({
              map: map,
              position: place.geometry.location
            });
            google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent('<div><strong>".$place_name."</strong>' +
                '<br/>' + place.formatted_address + '</div>');
              infowindow.open(map, this);
            });
          }
        });";
		
	$endclude.= "var map;
      function initMap".$ID."() 
	  {
			map = new google.maps.Map(document.getElementById(".$ID."), {
			center: {lat: ".$lat.", lng: ".$lng."},
			zoom: ".$zoom.",
			mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			".$markr."
			".$place."
      }";
	$endclude.= "</script>"."<script src='https://maps.googleapis.com/maps/api/js?key=".$API_KEY."&libraries=places&callback=initMap".$ID."' async defer></script>
	<style>
		.map_google img, div, button, .map-control, .map-control img, div img
		{
			background:			transparent;
			background-color:	transparent;
		}
		.map_control
		{	display: none; }
		.map_google .map_control
		{	display: block; }
	</style>";
}



?>