@extends('layouts.master')

@section('content')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="{{ URL::asset('js/markermanager.js') }}"></script>

<div class="col-sm-12" id="map-canvas" style="height:87%"></div>	

<script type="text/javascript">

	function initialize() {
	
		/*
		// Create an array of styles.
		var styles = [
		  {
			"featureType": "poi",
			"stylers": [
			  { "visibility": "off" }
			]
		  },{
			"featureType": "landscape.natural.landcover",
			"stylers": [
			  { "visibility": "on" },
			  { "hue": "#ffaa00" },
			  { "saturation": 63 },
			  { "lightness": -33 },
			  { "gamma": 1.45 }
			]
		  }
		];*/

		// Create a new StyledMapType object, passing it the array of styles,
		// as well as the name to be displayed on the map type control.
		//var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});

		var options = {
            // Algemene opties kaartje //
            zoom: 5,
            center: new google.maps.LatLng({{$latitude}},{{$longitude}}),
            mapTypeId: google.maps.MapTypeId.TERRAIN,
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,	
				mapTypeIds: [
								//[google.maps.MapTypeId.TERRAIN, 'map_style'],
								google.maps.MapTypeId.TERRAIN,
								google.maps.MapTypeId.ROADMAP,
								google.maps.MapTypeId.SATELLITE
							]
			},
			navigationControl: true,
			navigationControlOptions: {
				style: google.maps.NavigationControlStyle.SMALL
				},
			scaleControl: true,
			streetViewControl: false
		}
		
        var map = new google.maps.Map(document.getElementById("map-canvas"), options);
		
		//Associate the styled map with the MapTypeId and set it to display.
		//map.mapTypes.set('map_style', styledMap);
		//map.setMapTypeId('map_style');

		var mgr = new MarkerManager(map);
		
		google.maps.event.addListener(mgr, 'loaded', function() {
			showgeos();
			showcols();
		});
				
		showgeos = function() {	
			var geos = new Array();
			var coords = new Array();
			var minzooms = new Array();
			var maxzooms = new Array();
			var nrcols = new Array();
			var i = 0;
			
			//load countries
			$.ajax({
				url : "{{ URL::asset('ajax/getcountries.php') }}",
				data : "",
				dataType : 'json',
				success : function(data) {
					for(var j = 0; j < data.length; j++)
					{								
						var img = "{{ URL::asset('images/ColRed.png') }}";
										
						var title = data[j].Country + ' (' + data[j].NrCols + ' cols)';	
						
						coords[i] = new google.maps.LatLng(data[j].Latitude/1000000,data[j].Longitude/1000000);
						minzooms[i] = parseInt(1);
						
						switch (parseInt(data[j].CountryID))
						{
							case 4: 
							case 5: 
							case 7: 
							case 4417: //FRA,ITA,SPA,GER
								maxzooms[i] = parseInt(5); break;
							case 3: 
							case 8: //AUT,SWI
								maxzooms[i] = parseInt(6); break;
							default:
								maxzooms[i] = parseInt(8); break;
						}
						
						var marker = new google.maps.Marker({
							position: coords[i],
							title: title,
							icon: img
							});
									
						geos[i] = marker;
						
						// Adding a click event to the marker
						(function(i){
							google.maps.event.addListener(geos[i], 'click', function() {
								var newZoom = maxzooms[i];
								newZoom = parseInt(newZoom) + 1;
								map.setCenter(coords[i]);
								map.setZoom(newZoom);
							});
						})(i);

						i = i + 1;
					}	
					
					for (var j = 0; j < geos.length-1; j++) {
						mgr.addMarker(geos[j], minzooms[j], maxzooms[j]);
					}
					mgr.refresh();					
				}
			})
			
			//load regions
			$.ajax({
				url : "{{ URL::asset('ajax/getregions.php') }}",
				data : "",
				dataType : 'json',
				success : function(data) {
					for(var j = 0; j < data.length; j++)
					{								
						var img = "{{ URL::asset('images/ColDarkOrange.png') }}";
										
						var title = data[j].Region + ' (' + data[j].NrCols + ' cols)';	
						
						coords[i] = new google.maps.LatLng(data[j].Latitude/1000000,data[j].Longitude/1000000);
						
						switch (parseInt(data[j].CountryID))
						{
							case 4: 
							case 5: 
							case 7: 
							case 4417: //FRA,ITA,SPA,GER
								minzooms[i] = parseInt(6); break;
							case 3: 
							case 8: //AUT,SWI
								minzooms[i] = parseInt(7); break;
							default:
								minzooms[i] = parseInt(8); break;
						}
						
						if (data[j].NrSubRegions > 0)
						{
							maxzooms[i] = minzooms[i];
						}
						else
						{
							maxzooms[i] = parseInt(8);
						}
						
						var marker = new google.maps.Marker({
							position: coords[i],
							title: title,
							icon: img
							});
									
						geos[i] = marker;
						
						// Adding a click event to the marker
						(function(i){
							google.maps.event.addListener(geos[i], 'click', function() {
								var newZoom = maxzooms[i];
								newZoom = parseInt(newZoom) + 1;
								map.setCenter(coords[i]);
								map.setZoom(newZoom);
							});
						})(i);

						i = i + 1;
					}	
					
					for (var j = 0; j < geos.length-1; j++) {
						mgr.addMarker(geos[j], minzooms[j], maxzooms[j]);
					}
					mgr.refresh();					
				}
			})
			
			//load subregions
			$.ajax({
				url : "{{ URL::asset('ajax/getsubregions.php') }}",
				data : "",
				dataType : 'json',
				success : function(data) {
					for(var j = 0; j < data.length; j++)
					{								
						var img = "{{ URL::asset('images/ColLightYellow.png') }}";
										
						var title = data[j].SubRegion + ' (' + data[j].NrCols + ' cols)';	
						
						coords[i] = new google.maps.LatLng(data[j].Latitude/1000000,data[j].Longitude/1000000);
						
						switch (parseInt(data[j].CountryID))
						{
							case 4: 
							case 5: 
							case 7: 
							case 4417: //FRA,ITA,SPA,GER
								minzooms[i] = parseInt(7); break;
							default:
								minzooms[i] = parseInt(8); break;
						}
						maxzooms[i] = parseInt(8);
						
						var marker = new google.maps.Marker({
							position: coords[i],
							title: title,
							icon: img
							});
									
						geos[i] = marker;
						
						// Adding a click event to the marker
						(function(i){
							google.maps.event.addListener(geos[i], 'click', function() {
								var newZoom = maxzooms[i];
								newZoom = parseInt(newZoom) + 1;
								map.setCenter(coords[i]);
								map.setZoom(newZoom);
							});
						})(i);

						i = i + 1;
					}	
					
					for (var j = 0; j < geos.length-1; j++) {
						mgr.addMarker(geos[j], minzooms[j], maxzooms[j]);
					}
					mgr.refresh();					
				}
			})
		}

		showcols = function() {
			var cols = new Array();
			var names = new Array();
			var ids = new Array();
			var heights = new Array();

			var infowindow =  new google.maps.InfoWindow({
				content: ''
			});

			$.ajax({
				url : "{{ URL::asset('ajax/getcols.php') }}",
				data : "",
				dataType : 'json',
				success : function(data) {
				
					for(var j = 0; j < data.length; j++)
					{								
						var img;
						if (data[j].Height > 2500) { img = "{{ URL::asset('images/ColRed.png') }}"; }
						else if (data[j].Height > 1500) { img = "{{ URL::asset('images/ColDarkOrange.png') }}"; }
						else if (data[j].Height > 1000) { img = "{{ URL::asset('images/ColOrange.png') }}"; }
						else if (data[j].Height > 500) { img = "{{ URL::asset('images/ColYellow.png') }}"; }
						else { img = "{{ URL::asset('images/ColLightYellow.png') }}"; }
										
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(data[j].Latitude/1000000,data[j].Longitude/1000000),
							title: data[j].Col,
							icon: img
							});
							
						names[j] = data[j].Col;
						ids[j] = data[j].ColID;
						heights[j] = data[j].Height						
						cols[j] = marker;
						
						// Adding a click event to the marker
						(function(j){
							google.maps.event.addListener(cols[j], 'click', function() {
								location.href="{{ URL::asset('/') }}col/" + data[j].ColIDString;
							});
						})(j);
					}
					
					//alert(cols.length);
					mgr.addMarkers(cols, 9);
					// Making the MarkerManager add the markers to the map
					mgr.refresh();
				}
			})
		};		
	};

	google.maps.event.addDomListener(window, 'load', initialize);

</script>

@stop
