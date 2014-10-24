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

		var infobubble;
			
		google.maps.event.addListener(map, 'click', function() {
			if (infobubble)
			{
				infobubble.setMap(null);
			}
		});
		
		var mgr = new MarkerManager(map);
		
		showgeos = function() {	
			var geos = new Array();
			var coords = new Array();
			var minzooms = new Array();
			var maxzooms = new Array();
			var nrcols = new Array();
			var i = 0;
			
			@foreach ($countries as $country)
				
				var img = "{{ URL::asset('images/ColRed.png') }}";
				
				var title = "{{$country->Country}}" + ' (' + parseInt({{$country->NrCols}}) + ')';	
				
				coords[i] = new google.maps.LatLng({{$country->Latitude/1000000}},{{$country->Longitude/1000000}});
				minzooms[i] = parseInt(1);
				
				switch ({{$country->CountryID}})
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
					position: new google.maps.LatLng({{$country->Latitude/1000000}},{{$country->Longitude/1000000}}),
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
			@endforeach	
			
			
			@foreach ($regions as $region)
				
				var img = "{{ URL::asset('images/ColDarkOrange.png') }}";
				
				var title = "{{$region->Region}}" + ' (' + parseInt({{$region->NrCols}}) + ')';	
				
				coords[i] = new google.maps.LatLng({{$region->Latitude/1000000}},{{$region->Longitude/1000000}});
								
				switch ({{$region->CountryID}})
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
				
				if ({{$region->NrSubRegions}} > 0)
				{
					maxzooms[i] = minzooms[i];
				}
				else
				{
					maxzooms[i] = parseInt(8);
				}
				
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng({{$region->Latitude/1000000}},{{$region->Longitude/1000000}}),
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
			@endforeach	
			
			@foreach ($subregions as $subregion)
				
				var img = "{{ URL::asset('images/ColLightYellow.png') }}";
				
				var title = "{{$subregion->SubRegion}}" + ' (' + parseInt({{$subregion->NrCols}}) + ')';	
				
				coords[i] = new google.maps.LatLng({{$subregion->Latitude/1000000}},{{$subregion->Longitude/1000000}});
				switch ({{$subregion->CountryID}})
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
					position: new google.maps.LatLng({{$subregion->Latitude/1000000}},{{$subregion->Longitude/1000000}}),
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
			@endforeach
			
			google.maps.event.addListener(mgr, 'loaded', function() {
				for (var j = 0; j < geos.length-1; j++) {
					mgr.addMarker(geos[j], minzooms[j], maxzooms[j]);
				}
			});
		}

		showcols = function() {	
			//var lines = doc.split("\n");
			var cols = new Array();
			var names = new Array();
			var ids = new Array();
			var heights = new Array();
			var colors = new Array();
			var i = 0;
			
			@foreach ($cols as $col)
				var img;
				if ({{$col->Height}} > 2500) { img = "{{ URL::asset('images/ColRed.png') }}"; colors[i] = '#ff0000'; }
				else if ({{$col->Height}} > 1500) { img = "{{ URL::asset('images/ColDarkOrange.png') }}"; colors[i] = '#ff4d00'; }
				else if ({{$col->Height}} > 1000) { img = "{{ URL::asset('images/ColOrange.png') }}"; colors[i] = '#ff8000'; }
				else if ({{$col->Height}} > 500) { img = "{{ URL::asset('images/ColYellow.png') }}"; colors[i] = '#ffff00'; }
				else { img = "{{ URL::asset('images/ColLightYellow.png') }}"; colors[i] = '#ffff80'; }
								
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng({{$col->Latitude/1000000}},{{$col->Longitude/1000000}}),
					title: "{{$col->Col}}",
					icon: img
					});
					
				names[i] = "{{$col->Col}}";
				ids[i] = {{$col->ColID}};
				heights[i] = {{$col->Height}};
				
				cols[i] = marker;
				
				// Adding a click event to the marker
				(function(i){
					google.maps.event.addListener(cols[i], 'click', function() {
						location.href="{{ URL::asset('/') }}col/{{$col->ColIDString}}";
					});
				})(i);

				i = i + 1;
			@endforeach

				
			google.maps.event.addListener(mgr, 'loaded', function() {
				// These markers will be visible at zoom level 9 and deeper
				mgr.addMarkers(cols, 9);
				// Making the MarkerManager add the markers to the map
				mgr.refresh();
			});
		}
		
		showcols();
		showgeos();
	};

	google.maps.event.addDomListener(window, 'load', initialize);

</script>

@stop
