@extends('layouts.master')

@section('content')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">	
	var map;
	function initialize(){
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
		];
		
		var pos = new google.maps.LatLng({{$col->Latitude/1000000}},{{$col->Longitude/1000000}});

		// Create a new StyledMapType object, passing it the array of styles,
		// as well as the name to be displayed on the map type control.
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});

		// Create a map object, and include the MapTypeId to add
		// to the map type control.
		var options = {
			zoom: 4,
			center: pos,
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			panControl: false,
		    zoomControl: false,
		    mapTypeControl: false,
		    scaleControl: false,
		    streetViewControl: false,
		    overviewMapControl: false
		};
		  
		map = new google.maps.Map(document.getElementById('map'), options);
						
		//Associate the styled map with the MapTypeId and set it to display.
		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');
		  
		var marker = new google.maps.Marker({
					position: pos,
					icon: "{{ URL::asset('images/ColRed.png') }}"
					});
					
		marker.setMap(map);
			
		google.maps.event.addListener(map, 'click', function() {
			parent.document.location.href = "{{ URL::asset('/')}}map/col/{{$col->ColIDString}}";
		});

		google.maps.event.addListener(marker, 'click', function() {
			parent.document.location.href = "{{ URL::asset('/')}}map/col/{{$col->ColIDString}}";
		});
	}			

	google.maps.event.addDomListener(window, 'load', initialize);	
</script>
<?php 
	$colname = str_replace('/','<br/>',$col->Col);

	//create country string(s)
	$country1 = $col->Country1;
	$country2 = $col->Country2;
	
	$region1 = $col->Region1;
	$region2 = $col->Region2;
	
	$subregion1 = $col->SubRegion1;
	$subregion2 = $col->SubRegion2;
	
	if ($country2)
	{
		if ($region2)
		{
			$country2 .= ", " . $region2;
			
			if ($subregion2)
			{
				$country2 .= ", " . $subregion2;
			}
		}
	}
	
	if ($region1)
	{
		$country1 .= ", " . $region1;
		
		if ($region2 && !$country2)
		{
			$country1 .= ", " . $region2;
		}
	
		if ($subregion1)
		{
			$country1 .= ", " . $subregion1;
		}
		
		if ($subregion2 && !$country2)
		{
			$country1 .= ", " . $subregion2;
		}		
	}
?>
<div class="colpage">
    <div class="colimage" style='background-image: 
         url( {{URL::asset("images/cols/chasseral/P1010004.JPG") }} );'>
    </div>
    <div class="coltitlesection">

        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-2 coltitle">
                <h1>{{$colname}}</h1>
				<h3><img src="{{ URL::asset('images/flags/' . $col->Country1 . '.gif') }}"/> {{$country1}}</h3>
                @if ($country2)
                <h3><img src="{{ URL::asset('images/flags/' . $col->Country2 . '.gif') }}"> {{$country2}}</h3>
                <!--<h1>Col du Grand-Saint-Bernard</h1>-->
				@endif
            </div>

            <div class="col-md-2 altitude">
                <div class="col-xs-6 altitudetext"><h1>{{$col->Height}}m</h1></div>
				@if ($col->PanelURL)
				<div class="col-xs-5 altitudesign">
                    <!--<img src="{{ URL::asset('images/cols/chasseral/Chasseral.jpg') }}" />-->
                    <img src="http://www.cyclingcols.com/photos/{{$col->PanelURL}}" />
                </div>
				@endif
            </div>
        </div>
        <div class="col-md-12 buttons">
            <div class="col-xs-4 col-md-2">
                <div class='prevbutton'>

                    <i class="glyphicon glyphicon-arrow-left"></i>
                    <p>previous col in Switzerland (Alfabetic)</p>

                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-8">
                <div class='nextbutton'>

                    <p>next col in Switzerland (Alfabetic)</p>
                    <i class="glyphicon glyphicon-arrow-right"></i>

                </div>
            </div>    
        </div>
    </div>

    <div class="col-md-12 nrprofiles">
<?php 

$profile_count = 0; 
$profile_string = "";

foreach($profiles as $profile) {
	$profile_count = $profile_count + 1;
	if ($profile_count > 1) {$profile_string .= " | ";}
	$profile_string .= "<a href='#profile" . $profile_count . "'>" . $profile->Side . " (from " . $profile->Start . ")</a>";
}

$profile_string = ": " . $profile_string;
if ($profile_count > 1) {$profile_string = "s" . $profile_string;}
$profile_string = $profile_count . " profile" . $profile_string;
?>
        <p>{{$profile_string}}</p>
    </div>

	<div class="profileinfo">
        <div class="col-md-8 leftinfo">
<?php
$profile_count = 0;

foreach($profiles as $profile) {
	$profile_count = $profile_count + 1;
	
	//find stat colors
	$distance_cat = 0;
	if($profile->Distance < 50) {$distance_cat = 5;} 
	elseif($profile->Distance < 100) {$distance_cat = 4;} 
	elseif($profile->Distance < 150) {$distance_cat = 3;} 
	elseif($profile->Distance < 200) {$distance_cat = 2;} 
	else {$distance_cat = 1;} 
	
	$heightdiff_cat = 0;
	if($profile->HeightDiff < 500) {$heightdiff_cat = 5;} 
	elseif($profile->HeightDiff < 1000) {$heightdiff_cat = 4;} 
	elseif($profile->HeightDiff < 1500) {$heightdiff_cat = 3;} 
	elseif($profile->HeightDiff < 2000) {$heightdiff_cat = 2;} 
	else {$heightdiff_cat = 1;} 
	
	$avgperc_cat = 0;
	if($profile->AvgPerc < 40) {$avgperc_cat = 5;} 
	elseif($profile->AvgPerc < 60) {$avgperc_cat = 4;} 
	elseif($profile->AvgPerc < 80) {$avgperc_cat = 3;} 
	elseif($profile->AvgPerc < 100) {$avgperc_cat = 2;} 
	else {$avgperc_cat = 1;} 
		
	$maxperc_cat = 0;
	if($profile->MaxPerc < 60) {$maxperc_cat = 5;} 
	elseif($profile->MaxPerc < 80) {$maxperc_cat = 4;} 
	elseif($profile->MaxPerc < 100) {$maxperc_cat = 3;} 
	elseif($profile->MaxPerc < 120) {$maxperc_cat = 2;} 
	else {$maxperc_cat = 1;} 
		
	$profileidx_cat = 0;
	if($profile->ProfileIdx < 300) {$profileidx_cat = 5;} 
	elseif($profile->ProfileIdx < 500) {$profileidx_cat = 4;} 
	elseif($profile->ProfileIdx < 700) {$profileidx_cat = 3;} 
	elseif($profile->ProfileIdx < 900) {$profileidx_cat = 2;} 
	else {$profileidx_cat = 1;} 
?>
	        <div class="col-md-12" id="profile{{$profile_count}}">
                <div class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-11">{{$col->Col}} <strong>{{$profile->Side}}</strong><br/><span style="font-size:12px;">from {{$profile->Start}}</span></h4>
                        <div class="col-xs-1" style="padding: 0px;">
                            <div class="category c{{$profile->Category}}">{{$profile->Category}}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 profilestats">
						Distance <span class="profilestat c{{$distance_cat}}">{{number_format($profile->Distance/10,1)}} km</span>
                        &nbsp;Height Difference <span class="profilestat c{{$heightdiff_cat}}">{{$profile->HeightDiff}}m</span>
                        &nbsp;Average Slope <span class="profilestat c{{$avgperc_cat}}">{{number_format($profile->AvgPerc/10,1)}}%</span>
                        &nbsp;Maximum Slope <span class="profilestat c{{$maxperc_cat}}">{{number_format($profile->MaxPerc/10,1)}}%</span>
                        &nbsp;Profile Index <span class="profilestat c{{$profileidx_cat}}">{{$profile->ProfileIdx}}</span>
                    </div>
					<div class="col-sm-12 profileimage">
						<!--<img align="left" style="margin: 0px 0px 0px 0px" src="{{ URL::asset('profiles/' . $profile->FileName . '.gif') }}"/>-->
						<img align="left" style="margin: 0px 0px 0px 0px" src="http://www.cyclingcols.com/profiles/{{$profile->FileName}}.gif" />
					</div>
                </div>
            </div>
<?php
}
?>
        </div>


        <div class="col-md-4 rightposition">
            <div class="rightinfo">
                <div id="map" class="colmap" style="width: 100%; height: 400px; ">
                    <!--<iframe width="100%" height="400px" frameborder="0" style="border:0" 
                            src="https://www.google.com/maps/embed/v1/place?q=chasseral&key=AIzaSyAygOiuwB64V3LNNXX5i6p-gRArxV1-P94"></iframe>-->
					
                </div>
                <div class="support">
                    <h3>Support Cyclingcols</h3>
                </div>
                <div class="profs">
                    <h3>First on top in professional Cycling</h3>
                </div>            
                <div class="randomimage">
                    <img src="{{ URL::asset('images/cols/chasseral/P1010006.JPG') }}"/>
                </div>
            </div>
        </div>
    </div>


</div>

@stop
