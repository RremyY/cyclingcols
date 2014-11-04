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
				@endif
            </div>

            <div class="col-md-2 col-xs-12 altitude">
                <div class="col-xs-6 col-md-6 altitudetext"><h1>{{$col->Height}}m</h1></div>
				@if ($col->PanelURL)
				<div class="col-xs-6 col-md-7 colpanel"">
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
	        <div id="profile{{$profile_count}}">
                <div class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-11">{{$col->Col}} <strong>{{$profile->Side}}</strong><br/><span style="font-size:12px;">from {{$profile->Start}}</span></h4>
                        <div class="col-xs-1" style="padding: 0px;">
                            <div class="category c{{$profile->Category}}">{{$profile->Category}}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 profilestats">
						<div class="profilestat_wrapper">Distance <span class="profilestat c{{$distance_cat}}">{{number_format($profile->Distance/10,1)}} km</span></div>
                        <div class="profilestat_wrapper">Height Difference <span class="profilestat c{{$heightdiff_cat}}">{{$profile->HeightDiff}}m</span></div>
                        <div class="profilestat_wrapper">Average Slope <span class="profilestat c{{$avgperc_cat}}">{{number_format($profile->AvgPerc/10,1)}}%</span></div>
                        <div class="profilestat_wrapper">Maximum Slope <span class="profilestat c{{$maxperc_cat}}">{{number_format($profile->MaxPerc/10,1)}}%</span></div>
                        <div class="profilestat_wrapper">Profile Index <span class="profilestat c{{$profileidx_cat}}">{{$profile->ProfileIdx}}</span></div>
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
                    <div class="supporttitle">
					<form class="donate" align="center" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6ME8CQEG33GT4">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form>
					</div>
					<div class="supporttext">
					If you appreciate the services of CyclingCols, you could thank by doing a donation. This will promote the continuity and development of CyclingCols.
					</div>
				</div>
				<div class="reclame">
@if(in_array($col->ColID,array(198)))
					<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/logochaletbeyond_grossglockner.gif" border="0"/></a>
@endif
@if(in_array($col->ColID,array(485,519,577)))
					<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/logochaletbeyond_ventoux.gif" border="0"/></a>
@endif
@if(in_array($col->ColID,array(520,570)))
					<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/logochaletbeyond.gif" border="0"/></a>
@endif
@if(in_array($col->ColID,array(634)))
					<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/logochaletbeyond_stelvio.gif" border="0"/></a>
@endif
@if(in_array($col->ColID,array(398,399,444,475,485,519,526,542,570,577,578,634,655,1549,1553)))
					<a href="http://www.cyclosouvenir.be" target="_blank"><img src="../images/banners/bannercyclosouvenir.png" border="0"/></a>
@endif
				</div>
<?php
	$passages = Passage::where('ColID',$col->ColID)->orderBy('Edition','DESC')->get();
	
	if (count($passages) > 0) {
		$count = 0;
?>	
				<div class="profs">
					<div class="profstitle"><h4>First On Top</h4></div>
<?php
		for ($i = 0; $i < count($passages) && $i < 5; $i++) {
			$passage = $passages[$i];
			$event = "";
			switch($passage->EventID) {
				case 1: $event = "Tour de France"; break;
				case 2: $event = "Giro d'Italia"; break;
				case 3: $event = "Vuelta a España"; break;
			}
			
			$person = $passage->Person;
			$person_class = "rider";
			$flag = true;
			if ($passage->Neutralized) {$person = "-neutralized-"; $flag = false;}
			elseif ($passage->Cancelled) {$person = "-cancelled-"; $flag = false;}
?>	
					<div class="profrow clearfix">
						<div class="year">{{$passage->Edition}}</div> 
						<div class="race"><i>{{$event}}</i></div> 
						<div class="rider">{{$person}}</div>
					@if ($flag)
						<div class="profcountry"><img src="{{ URL::asset('images/flags/small/'. $passage->NatioAbbr . '.gif') }}"></div>
					@endif
					</div>       
<?php		
		}
		
		if (count($passages) > 5) {
?>
		<div class="profrow"><a href="#">show all</a></div>
<?php
		}
?>	
				</div>
<?php		
	}
?>
                 <div class="randomimage">
                    <img src="{{ URL::asset('images/cols/chasseral/P1010006.JPG') }}"/>
                </div>
            </div>
        </div>
    </div>


</div>

@stop
