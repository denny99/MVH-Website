 
  function initialize() {
	var directionsDisplay;
 	var directionsService = new google.maps.DirectionsService();
 	var map;
	document.getElementById("directionsPanel").style.height="0px";
    var geocoder = new google.maps.Geocoder();
	directionsDisplay = new google.maps.DirectionsRenderer();
    var mylatlng = new google.maps.LatLng(49.946693,7.472626);
    var myOptions = {
      zoom: 16,
      center: mylatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
	      }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById("directionsPanel"));
	
	var control = document.getElementById('control');
	control.style.display = 'block';
	map.controls[google.maps.ControlPosition.TOP].push(control);
	
	var contentString = '<div>'+'<p>MVH Maschinenbau AG <br/> Hauptstrasse 8 <br/>55469 Oppertshausen</p>'+
    '</div>';

	var infowindow = new google.maps.InfoWindow({
    content: contentString});
	
	
	var marker = new google.maps.Marker({
      position: mylatlng,
      map: map, 
      title:"MVH Maschinenbau AG"
  });
  
  infowindow.open(map,marker);
  
        var input = document.getElementById('address');
        autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);


google.maps.event.addListener(autocomplete, 'place_changed', function() {
	document.getElementById("directionsPanel").style.height="200px";
	infowindow.close();
  	var place = autocomplete.getPlace();
	var ort = place.formatted_address;
    geocoder.geocode( { 'address':ort}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {		
		<!-- Routeplaner-->
		  pos1 = results[0].geometry.location;
		  pos2 = mylatlng;
		  request = {
			origin:pos1,
			destination:pos2,
			travelMode: google.maps.TravelMode.DRIVING
		  };
	  }
	 
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
	});
});
  }


