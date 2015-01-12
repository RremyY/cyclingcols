@extends('layouts.master')

@include('includes.functions')

@section('content')
<script src="{{ URL::asset('js/col.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">	
	var root = '{{ URL::asset("/")}}';
	
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
		    overviewMapControl: false,
			scrollwheel: false
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

	$(document).ready(function() {
		getColsNearby({{$col->ColID}});
		getPassages({{$col->ColID}});
		getPrevNextCol({{$col->Number}});
		getTopStats({{$col->ColID}});
	});

</script>
<?php
	$double_name = false;
	$colname = $col->Col;
	
	// if slash is multi-language separator then replace slash by break
	if (strpos($col->Aliases,$col->Col) == false) {
		$colname = str_replace('/','<br/>',$colname);
		$double_name = true;
	}
	
	//aliases
	$aliases = explode(';',$col->Aliases);
	$aliases_str = "";
	for($i = 0; $i < count($aliases); $i++)
	{
		if (strlen($aliases[$i]) > 0)
		{
			if (!strstr($col->Col,$aliases[$i]))
			{
				if (strlen($aliases_str) > 0) { $aliases_str .= ", "; }
				$aliases_str .= $aliases[$i];
			}
		}
	}

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
				$country2 .= " (" . $subregion2 . ")";
			}
		}
	}
	
	if ($region1)
	{
		$country1 .= ", " . $region1;
	
		if ($subregion1)
		{
			$country1 .= " (" . $subregion1;
			
			if ($subregion2 && !$region2)
			{
				$country1 .= ", ". $subregion2 . ")";
			}
			else
			{
				$country1 .= ")";
			}
		}
		
		if ($region2 && !$country2)
		{
			$country1 .= ", " . $region2;
			
			if ($subregion2)
			{
				$country1 .= " (" . $subregion2 . ")";
			}		
		}	
	}
	
	$cover = 'images/covers/' . $col->ColIDString . '.jpg';
	$cover_url = URL::asset($cover);
	$backgroundpos = 30;
	if ($col->CoverPhotoPosition) { $backgroundpos = $col->CoverPhotoPosition; }
	
	//@if($col->CoverPhotoPosition) -> deze code ipv file_exists
	
?>
<div class="colpage">
	@if(file_exists(public_path($cover)))
	<div class="colimage" style='background-image: url( {{$cover_url}} ); background-position: 0% {{ $backgroundpos}}%'>
		<!--@if($col->HasImages)
		<div class="view_slideshow"><a href="../slideshow/{{$col->ColIDString}}">View Slideshow</a></div>     
		@endif-->
	</div>
	@else
    <div class="colimage" style='background-image: url( {{URL::asset("images/covers/_Dummy.jpg")}} ); background-position: 0% 28%'>
		<!--@if($col->HasImages)
		<div class="view_slideshow"><a href="../slideshow/{{$col->ColIDString}}">View Slideshow</a></div>     
		@endif-->
	</div>	
	@endif
    <div class="coltitlesection col-xs-12">
		<div class="col-md-3 col-sm-3 colleft">
			@if ($col->PanelURL)
			<div class="colpanel"">
				<!--<img src="{{ URL::asset('images/cols/chasseral/Chasseral.jpg') }}" />-->
				<img src="http://www.cyclingcols.com/photos/{{$col->PanelURL}}" />
			</div>
			@endif
		</div>
		<div class="col-md-6 col-sm-9 col-xs-12 coltitle">
			<h2 class="colname">{{$colname}}</h2>
			@if ($double_name)	
			<span class="colheight moveup">
			@else
			<span class="colheight">
			@endif
			{{$col->Height}}m</span>
			@if (strlen($aliases_str) > 0)
			<h4>({{$aliases_str}})</h4>
			@endif
			<h3><img src="{{ URL::asset('images/flags/' . $col->Country1 . '.gif') }}"/> {{$country1}}</h3>
			@if ($country2)	
			<h3><img src="{{ URL::asset('images/flags/' . $col->Country2 . '.gif') }}"> {{$country2}}</h3>
			@endif
		</div>
<?php	
	session_start();
	
	if(isset($_SESSION['colcount'])) {
		$colcount = $_SESSION['colcount'];
	}
	else {
		$colcount = Col::all()->count();
		$_SESSION['colcount'] = $colcount;
	}		
?>
		<div class="col-md-3 col-sm-12 colright">
			<div class="colcount col-md-12 col-sm-4">Col # {{$col->Number}} of {{$colcount}} (alphabetical)</div>
			<div class="prevbutton col-md-12 col-sm-4">
				<div class="glyphicon glyphicon-arrow-left"></div>
			</div>
			<div class="nextbutton col-md-12 col-sm-4">
				<div class="glyphicon glyphicon-arrow-right"></div>          
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
	$profile_string .= "<a href='#profile" . $profile->ProfileID . "'>" . $profile->Side . " (from " . $profile->Start . ")</a>";
}

$profile_string = ": " . $profile_string;
if ($profile_count > 1) {$profile_string = "s" . $profile_string;}
$profile_string = $profile_count . " profile" . $profile_string;
?>
        <p>{{$profile_string}}</p>
    </div>

	<div>
        <div class="col-sm-8 leftinfo">
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
	if($profile->HeightDiff < 400) {$heightdiff_cat = 5;} 
	elseif($profile->HeightDiff < 800) {$heightdiff_cat = 4;} 
	elseif($profile->HeightDiff < 1300) {$heightdiff_cat = 3;} 
	elseif($profile->HeightDiff < 1800) {$heightdiff_cat = 2;} 
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
	
	$profileIDString = $col->ColIDString;
	if ($profile->Side) {
		$profileIDString .= "_" . $profile->Side;
	}	
?>
	        <div id="profile{{$profile->ProfileID}}">
                <div id="{{$profileIDString}}" class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-11">{{$col->Col}}
@if ($profile->SideID > 0)
						<img src="{{URL::asset('images/')}}/{{$profile->Side}}.png")}}' title='{{$profile->Side}}'/><span class="profile_side">{{$profile->Side}}</span>
@endif
						<br/>
						<span class="profile_start">from {{$profile->Start}}</span></h4>
                        <div class="col-xs-1" style="padding: 0px;">
                            <div class="category c{{$profile->Category}}" title="Category {{$profile->Category}}">{{$profile->Category}}</div>
                        </div>
                    </div>
                    <!--<div class="col-xs-12 profilestats">
						<div class="profilestat_wrapper">Distance <span class="profilestat c{{$distance_cat}}">{{number_format($profile->Distance/10,1)}} km</span></div>
                        <div class="profilestat_wrapper">Altitude Gain <span class="profilestat c{{$heightdiff_cat}}">{{$profile->HeightDiff}}m</span></div>
                        <div class="profilestat_wrapper">Average Slope <span class="profilestat c{{$avgperc_cat}}">{{number_format($profile->AvgPerc/10,1)}}%</span></div>
                        <div class="profilestat_wrapper">Maximum Slope <span class="profilestat c{{$maxperc_cat}}">{{number_format($profile->MaxPerc/10,1)}}%</span></div>
                        <div class="profilestat_wrapper">Profile Index <span class="profilestat c{{$profileidx_cat}}">{{$profile->ProfileIdx}}</span></div>
                    </div>-->
					<div class="stats_wrapper">
						<div class="stat_value">{{formatStat(1,$profile->Distance)}}</div>
						<a href="{{URL::asset('stats/1')}}"><img class="stat_icon" src="{{URL::asset('images/' . statNameShort(1) . '.png')}}" title="{{statName(1)}}" /></a>
						<div class="stat_bar profilestat c{{$distance_cat}}" style="width:{{90-$distance_cat*15}}px;" title="{{statName(1)}}">{{$distance_cat}}</div>
						<div class="stat_top stat_top_1"></div>	
						<div class="stat_value">{{formatStat(2,$profile->HeightDiff)}}</div>
						<a href="{{URL::asset('stats/2')}}"><img class="stat_icon" src="{{URL::asset('images/' . statNameShort(2) . '.png')}}" title="{{statName(2)}}" /></a>
						<div class="stat_bar profilestat c{{$heightdiff_cat}}" style="width:{{90-$heightdiff_cat*15}}px;" title="{{statName(2)}}">{{$heightdiff_cat}}</div>
						<div class="stat_top stat_top_2"></div>	
						<div class="stat_value">{{formatStat(3,$profile->AvgPerc)}}</div>
						<a href="{{URL::asset('stats/3')}}"><img class="stat_icon" src="{{URL::asset('images/' . statNameShort(3) . '.png')}}" title="{{statName(3)}}" /></a>
						<div class="stat_bar profilestat c{{$avgperc_cat}}" style="width:{{90-$avgperc_cat*15}}px;" title="{{statName(3)}}">{{$avgperc_cat}}</div>
						<div class="stat_top stat_top_3"></div>	
						<div class="stat_value">{{formatStat(4,$profile->MaxPerc)}}</div>
						<a href="{{URL::asset('stats/4')}}"><img class="stat_icon" src="{{URL::asset('images/' . statNameShort(4) . '.png')}}" title="{{statName(4)}}" /></a>
						<div class="stat_bar profilestat c{{$maxperc_cat}}" style="width:{{90-$maxperc_cat*15}}px;" title="{{statName(4)}}">{{$maxperc_cat}}</div>
						<div class="stat_top stat_top_4"></div>	
						<div class="stat_value">{{formatStat(5,$profile->ProfileIdx)}}</div>
						<a href="{{URL::asset('stats/5')}}"><img class="stat_icon" src="{{URL::asset('images/' . statNameShort(5) . '.png')}}" title="{{statName(5)}}" /></a>
						<div class="stat_bar profilestat c{{$profileidx_cat}}" style="width:{{90-$profileidx_cat*15}}px;" title="{{statName(5)}}">{{$profileidx_cat}}</div>		
						<div class="stat_top stat_top_5"></div>	
					</div>
					<div class="profile_print">
						<span class="glyphicon glyphicon-print" title="print"></span>
					</div>
					<div class="profileimage clearfix">
						<!--<img align="left" style="margin: 0px 0px 0px 0px" src="{{ URL::asset('profiles/' . $profile->FileName . '.gif') }}"/>-->
						<img align="left" src="http://www.cyclingcols.com/profiles/{{$profile->FileName}}.gif" />
					</div>
                </div>
            </div>
<?php
}
?>
        </div>


        <div class="col-sm-4 rightposition">
            <div class="rightinfo">
                <div id="map" class="colmap">
                </div>
				<div class="colsnearby" id="colsnearby">
					<div class="colsnearbytitle">
						Cols Nearby
					</div>
					<div id="colsnearbyrows" class="colsnearbyrows clearfix">
					</div>
				</div>
                <div id="donate" class="support">
                    <div class="supporttitle">
					<form class="donate" align="center" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6ME8CQEG33GT4">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form>
					</div>
					<div class="supporttext">
					If you enjoy the services of CyclingCols, you can thank by making a donation. This will promote the continuity and development of CyclingCols.
					</div>
				</div>
<?php
	$reclame_count = 0;
	$reclame = "";

	if(in_array($col->ColID,array(198))) {
		$reclame .= '<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/LogoChaletBeyond_Grossglockner.gif"/></a>';
		$reclame_count++;
	}
	if(in_array($col->ColID,array(485,519,577))) {
		$reclame .= '<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/LogoChaletBeyond_Ventoux.gif"/></a>';
		$reclame_count++;
	}
	if(in_array($col->ColID,array(520,570))) {
		$reclame .= '<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/LogoChaletBeyond.gif"/></a>';
		$reclame_count++;
	}
	if(in_array($col->ColID,array(634))) {
		$reclame .= '<a href="http://www.chaletbeyond.nl?page=fietsarrangementen" target="_blank"><img src="../images/banners/LogoChaletBeyond_Stelvio.jpg"/></a>';
		$reclame_count++;
	}
	if(in_array($col->ColID,array(398,399,444,475,485,519,526,542,570,577,578,634,655,1549,1553))) {
		$reclame .= '<a href="http://www.cyclosouvenir.be" target="_blank"><img src="../images/banners/BannerCyclosouvenir.png"/></a>';
		$reclame_count++;
	}
?>	

	@if ($reclame_count > 0)
	<div id="reclame" class="reclame">
	{{$reclame}}
	</div>
	@endif
	
	<div class="profs" id="profs">
	<div class="profstitle">
		<h4>First On Top
		<a id="show_or_hide_a" href="javascript:showAllPassages()"><img align="right" id="show_or_hide" width="20" src="{{ URL::asset('images/expand.png') }}" title="expand list"/></a>						
		</h4>
	</div>
	<div id="profrows" class="profrows">

<?php
	/*$passages = Passage::where('ColID',$col->ColID)->orderBy('Edition','DESC')->get();
	
	if (count($passages) > 0) {
		$count = 0;
?>	
				<div class="profs" id="profs">
					<div class="profstitle">
						<h4>First On Top
@if (count($passages) > 5)
						<a id="show_or_hide_a" href="javascript:showAllPassages()"><img align="right" id="show_or_hide" width="20" src="{{ URL::asset('images/expand.png') }}" title="expand list"/></a>						
@endif
						</h4>
					</div>
					<div id="profrows" class="profrows">
<?php
		for ($i = 0; $i < count($passages); $i++) {
			$passage = $passages[$i];
			$race = ""; 
			$race_short = "";
			
			switch($passage->EventID) {
				case 1: $race = "Tour de France"; $race_short = "Tour"; break;
				case 2: $race = "Giro d'Italia"; $race_short = "Giro"; break;
				case 3: $race = "Vuelta a España"; $race_short = "Vuelta"; break;
			}
			
			$person = $passage->Person;
			$person_class = "rider";
			$flag = true;
			if ($passage->Neutralized) {$person = "-neutralized-"; $flag = false;}
			elseif ($passage->Cancelled) {$person = "-cancelled-"; $flag = false;}
			elseif ($passage->NatioAbbr == "") {$person = "-cancelled-"; $flag = false;}
			
			$hidden = "profrow_hidden";
			if ($i < 5) {$hidden = "";}
?>	
					<div class="profrow {{$hidden}} clearfix">
						<div class="year">{{$passage->Edition}}</div> 
						<div class="race"><i>{{$race}}</i></div> 
						<div class="race_short" title="{{$race}}"><i>{{$race_short}}</i></div> 
						<div class="rider">{{$person}}</div>
					@if ($flag)
						<div class="profcountry"><img src="{{ URL::asset('images/flags/small/'. strtolower($passage->NatioAbbr) . '.gif') }}"></div>
					@endif
					</div>       
<?php		
		}
?>	
				</div>
<?php		
	}*/
?>
				</div>
                <!--<div class="randomimage">
                    <img src="{{ URL::asset('images/cols/chasseral/P1010006.JPG') }}"/>
                </div>-->
            </div>
        </div>
    </div>
</div>

@stop
