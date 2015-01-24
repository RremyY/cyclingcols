@extends('layouts.home')

@section('content')

<div class="overmain">
    <div class="homemenu">
        <div class="homelogo">
            <a href="{{ URL::asset('/') }}"><img id="logo_img" src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
        <ul class='tabrow'>
            <a href="{{url('/')}}"><li class="selectedtab"><i class="glyphicon glyphicon-home" title="Home"></i><span class="headertext">Home</span></li></a>
            <a href="{{url('/new')}}"><li><i class="glyphicon glyphicon-asterisk" title="New"></i><span class="headertext">New</span></li></a>
            <a href="{{url('/stats')}}"><li><i class="glyphicon glyphicon-stats" title="Stats"></i><span class="headertext">Stats</span></li></a>
            <a href="{{url('/help')}}"><li><i class="glyphicon glyphicon-question-sign" title="Help"></i><span class="headertext">Help</span></li></a>
            <a href="{{url('/about')}}"><li class="about"><i class="glyphicon glyphicon-info-sign" title="About"></i><span class="headertext">About</span></li></a>
			<div id="twitter">
				<img src="{{ URL::asset('images/twitter.png') }}" title="Follow CyclingCols on twitter!"/>
			</div>         
        </ul>
		
		<?php
	$banners = Banner::whereRaw('ColID = 0 AND Active = 1')->orderBy(DB::raw('RAND()'))->get();

	$reclame_count = 0;
	$reclame_left = "";
	$reclame_right = "";

	foreach($banners as $banner) {
		break;
		if ($reclame_count < 2) {
			$reclame_left .= '<a href="http://' . $banner->RedirectURL . '" target="_blank">
				<img src="../images/banners/' . $banner->BannerFileName . '"/>
			</a>
			<div class="reclame_close left">&times;</div>';
		} elseif ($reclame_count < 4) {
			$reclame_right .= '<a href="http://' . $banner->RedirectURL . '" target="_blank">
				<img src="../images/banners/' . $banner->BannerFileName . '"/>
			</a>
			<div class="reclame_close right">&times;</div>';
		}
		$reclame_count++;
	}
?>	
		@if ($reclame_left != "")
		<div id="reclame_left" class="reclame_main reclame_left">
		{{$reclame_left}}
		</div>
		@endif
		@if ($reclame_right != "")
		<div id="reclame_right" class="reclame_main reclame_right">
		{{$reclame_right}}
		</div>
		@endif
	</div>

</div>

<div id="bloodhound" class="abs" style="display:none">
	<input type="text" class="searchfield form-control typeahead search_main" placeholder="Search a col in Europe..." name="colid" id="searchbox">
</div>
<div id="searchonmap" style="display:none">
	<a href="{{url('/map')}}"><div class="btn btn-default globe" type="submit" title="Search on map"><img src="{{ URL::asset('images/globeblack.png') }}" alt="" /></div></a>
</div>
<div id="photogrid">
</div>

<style type="text/css">

</style>

<script type="text/javascript" charset="utf-8">
	var photos = [];
	var nrCols;
	var nrRows;
	var lastPhoto;
	
	$(document).ready(function() {	
		calculatephotogridheight();
		getPhotos();		
	});
	
	$(window).resize(function() {
		calculatephotogridheight();
		arrangePhotoGrid();
	});
	
	function getPhotos() {
		$.ajax({
			url : "{{ URL::asset('ajax/getphotos.php') }}",
			data : "",
			dataType : 'json',
			success : function(data) {
				photos = data;
				arrangePhotoGrid();
			}
		})
	}
	
	/*sets the height of the map-canvas so that it always fills the screen height*/
	function calculatephotogridheight() {
		$('#photogrid').height(($('.footer').offset().top) - ($('#photogrid').offset().top));
	}
	
	function changeRandomPhoto() {
		setTimeout(function(){
			if (lastPhoto < photos.length) {
				//get random div
				var nr = Math.floor(nrCols * nrRows * Math.random());
				//nr = 1;
				var div = $(".photo:eq(" + nr + ")");
				var divHeader = $("#" + $(".photo:eq(" + nr + ")").attr("id").replace("photo","photoheader"));
				//alert($(".photo:eq(" + nr + ")").attr("id"));
				//alert($(divHeader).attr("id"));
				
				(function(lastPhoto2) {
					var colName = photos[lastPhoto2][1];
					colName += '<img src="{{ URL::asset('images/flags')}}/' + photos[lastPhoto2][3] + '.gif"></img>';

					//hide previous photo
					$(div).animate({opacity:0},1000,"linear",function(){
						//set new photo & header
						$(divHeader)						
							.html(colName)
							.attr("id","photoheader" + photos[lastPhoto2][0])
							.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photos[lastPhoto2][0];})
							.on("mouseenter",function(){
								$("#photo" + photos[lastPhoto2][0]).css("opacity",0.4);
								$("#photoheader" + photos[lastPhoto2][0]).show();
							})
							.on("mouseleave",function(){
								$("#photo" + photos[lastPhoto2][0]).css("opacity",1.0);
								$("#photoheader" + photos[lastPhoto2][0]).hide();
							});
							
						$(div)
							.attr("id","photo" + photos[lastPhoto2][0])
							.css("background-image", 'url(' + "{{ URL::asset('images/covers')}}/" + photos[lastPhoto2][0] + ".jpg" + ')')
							.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photos[lastPhoto2][0];})
							.on("mouseenter",function(){
								$("#photo" + photos[lastPhoto2][0]).css("opacity",0.4);
								$("#photoheader" + photos[lastPhoto2][0]).show();
							})
							.on("mouseleave",function(){
								$("#photo" + photos[lastPhoto2][0]).css("opacity",1.0);
								$("#photoheader" + photos[lastPhoto2][0]).hide();
							});
					});
					
					//show new photo
					$(div).animate({opacity:1},2000,"swing");
					
				})(lastPhoto);
					
				lastPhoto++;
				changeRandomPhoto();
			}
		}, 10000);
	}
	
	function arrangePhotoGrid() {
		$("#bloodhound").hide();
		$("#searchonmap").hide();
		$('body').append($("#bloodhound"));	
		$('body').append($("#searchonmap"));	
		$('#photogrid').empty();
		
		var width = $('#photogrid').width();
		var height = $('#photogrid').height();
		var padding = 4;
		
		nrCols = Math.ceil(width/320);
		nrRows = Math.ceil(height/210);
		
		//variables to make space for searchbox
		var colSearchStart = 1;
		var colSearchEnd = 2;
		if (nrCols > 3) {
			colSearchStart = 2;
			colSearchEnd = 3;
		}
		var rowSearch = Math.floor(nrRows/2) + 1;	
		
		var count = 0;
		var left = padding;
		var top = padding;
		var photoWidth = (width-padding*(nrCols+1))/nrCols;
		var photoHeight = (height-padding*(nrRows+1))/nrRows;
		
		for (col = 1; col <= nrCols; col++) {
			for (row = 1; row <= nrRows; row++) {
				(function(count2) {
					var colName = photos[count2][1];
					colName += '<img src="{{ URL::asset('images/flags')}}/' + photos[count2][3] + '.gif"></img>';

					var photoTop = 0;
					var photoBottom = 0;
			
					if (parseInt(col) >= parseInt(colSearchStart) && parseInt(col) <= parseInt(colSearchEnd)) {
						if (parseInt(row) == parseInt(rowSearch)) {
							photoTop = 20;
						}
						else if (parseInt(row) == parseInt(rowSearch-1)) {
							photoBottom = 20;
						}					
					}
					
					if (parseInt(row) == parseInt(rowSearch) && parseInt(col) == parseInt(colSearchStart)) {				
						//position searchbox
						var search = $("#bloodhound");
						$(search).css("left", left + "px")
							.css("top", (top - photoTop) + "px")
							.width((photoWidth * (colSearchEnd - colSearchStart + 1) - 40) + "px");				
						$('#photogrid').append(search);	
						$(search).show();
						var searchonmap = $("#searchonmap");
						$(searchonmap).css("left", left + "px")
							.css("top", (top - photoTop) + "px")
							.css("left", (left + photoWidth * (colSearchEnd - colSearchStart + 1) - 40 + 5) + "px");				
						$('#photogrid').append(searchonmap);	
						$(searchonmap).show();
					}
					
					var divHeader = document.createElement("div");
					$(divHeader)
						.addClass("photoheader")
						.css("left", left + "px")
						.css("top", (top + photoTop) + "px")
						.width(photoWidth - 10 + "px")
						.html(colName)
						.attr("id","photoheader" + photos[count2][0])
						.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photos[count2][0];})
						.on("mouseenter",function(){
							$("#photo" + photos[count2][0]).css("opacity",0.4);
							$("#photoheader" + photos[count2][0]).show();
						})
						.on("mouseleave",function(){
							$("#photo" + photos[count2][0]).css("opacity",1.0);
							$("#photoheader" + photos[count2][0]).hide();
						});
					$('#photogrid').append(divHeader);		
					
					var div = document.createElement("div");
					$(div)
						.addClass("photo")
						.css("left", left + "px")
						.css("top", (top + photoTop) + "px")
						.width(photoWidth + "px")
						.height((photoHeight - photoTop - photoBottom) + "px")
						.attr("id","photo" + photos[count2][0])
						.css("background-size", photoWidth + "px " + photoHeight + "px")
						.css("background-image", 'url(' + "{{ URL::asset('images/covers')}}/" + photos[count2][0] + ".jpg" + ')')
						.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photos[count2][0];})
						.on("mouseenter",function(){
							$("#photo" + photos[count2][0]).css("opacity",0.4);
							$("#photoheader" + photos[count2][0]).show();
						})
						.on("mouseleave",function(){
							$("#photo" + photos[count2][0]).css("opacity",1.0);
							$("#photoheader" + photos[count2][0]).hide();
						});
					$('#photogrid').append(div);
				})(count);
					
				top += photoHeight + padding;
				count++;
			}
			
			left += photoWidth + padding;
			top = padding;
		}
			
		lastPhoto = count;
		changeRandomPhoto();
	}
</script>
@stop
