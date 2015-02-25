@extends('layouts.home')

@section('content')

<!--<div class="overmain">-->
    <div class="homemenu">
		<div id="menuleft" class="col-md-12">
			<div class="homelogo">
				<a href="{{ URL::asset('/') }}"><img id="logo_img" src="{{ URL::asset('images/logo.png') }}" /></a>
			</div>
			<a href="{{url('/')}}"><div class="menuitem"><i class="glyphicon glyphicon-home" title="Home"></i><span class="headertext">Home</span></div></a>
			<a href="{{url('/new')}}"><div class="menuitem"><i class="glyphicon glyphicon-asterisk" title="New"></i><span class="headertext">New</span></div></a>
			<a href="{{url('/stats')}}"><div class="menuitem"><i class="glyphicon glyphicon-stats" title="Stats"></i><span class="headertext">Stats</span></div></a>
			<a href="{{url('/help')}}"><div class="menuitem"><i class="glyphicon glyphicon-question-sign" title="Help"></i><span class="headertext">Help</span></div></a>
			<a href="{{url('/about')}}"><div class="menuitem"><i class="glyphicon glyphicon-info-sign" title="About"></i><span class="headertext">About</span></div></a>
			<div id="twitter">
				<img src="{{ URL::asset('images/twitter.png') }}" title="Follow CyclingCols on twitter!"/>
			</div>
		</div>
	</div>
<!--</div>-->

<div id="searchtext" class="abs" style="display:none">
	<input type="text" class="searchfield" placeholder="Search a col in Europe..." id="searchbox">
	<div id="searchstatus"></div>
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
	var photosShown = [];
	var banners = [];
	var bannersShown = [];
	var nrCols;
	var nrRows;
	
	$(document).ready(function() {	
		calculatephotogridheight();
		getPhotos();
		getBanners();
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
				if (photos.length > 0 && banners.length > 0) {
					arrangePhotoGrid();
					changeRandomPhoto();
					changeRandomBanner();
				}
			}
		})
	}
	
	function getBanners() {
		$.ajax({
			url : "{{ URL::asset('ajax/getbanners.php?colid=0') }}",
			data : "",
			dataType : 'json',
			success : function(data) {
				banners = data;
				if (photos.length > 0 && banners.length > 0) {
					arrangePhotoGrid();
					changeRandomPhoto();
					changeRandomBanner();
				}
			}
		})
	}
	
	/*sets the height of the map-canvas so that it always fills the screen height*/
	function calculatephotogridheight() {
		$('#photogrid').height(($('.footer').offset().top) - ($('#photogrid').offset().top));
	}
	
	function changeRandomPhoto() {
		setTimeout(function(){
			if (document.hasFocus()){
				//get random div
				var index = Math.floor(photosShown.length * Math.random());
				
				var photoHide = photosShown[index]; //pick random item of photosShown
				photosShown.splice(index,1); //remove random item from photosShown
				
				var photo = photos[0]; //pick first item of photos(NotShown)
				photos.shift(); //remove first item from photos(NotShown)
				
				photos.push(photoHide); //add random item to photo(NotShown)
				photosShown.push(photo); //add item to photoShown
				
				var div = $("#photo" + photoHide[0]);
				var divHeader = $("#photoheader" + photoHide[0]);
				
				//console.log("hidden:"+ photoHide[1]);
				//console.log("shown:"+ photo[1]);
						
				var colName = photo[1];
				colName += '<img src="{{ URL::asset('images/flags')}}/' + photo[3] + '.gif"></img>';

				//hide previous photo
				$(div).animate({opacity:0},1000,"linear",function(){
					//set new photo & header
					$(divHeader)						
						.html(colName)
						.attr("id","photoheader" + photo[0])
						.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photo[0];})
						.on("mouseenter",function(){
							$("#photo" + photo[0]).css("opacity",0.4);
							$("#photoheader" + photo[0]).show();
						})
						.on("mouseleave",function(){
							$("#photo" + photo[0]).css("opacity",1.0);
							$("#photoheader" + photo[0]).hide();
						});
						
					$(div)
						.attr("id","photo" + photo[0])
						.css("background-image", 'url(' + "{{ URL::asset('images/covers')}}/" + photo[0] + ".jpg" + ')')
						.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photo[0];})
						.on("mouseenter",function(){
							$("#photo" + photo[0]).css("opacity",0.4);
							$("#photoheader" + photo[0]).show();
						})
						.on("mouseleave",function(){
							$("#photo" + photo[0]).css("opacity",1.0);
							$("#photoheader" + photo[0]).hide();
						});
				});
				
				//show new photo
				$(div).animate({opacity:1},2000,"swing");
			}
				
			changeRandomPhoto();
		}, 10000);
	}
	
	function changeRandomBanner() {
		if (banners.length == 0) return;
		
		setTimeout(function(){
			if (document.hasFocus()){
				//get random banner
				var index = Math.floor(bannersShown.length * Math.random());
				
				var bannerHide = bannersShown[index]; //pick random item of bannersShown
				bannersShown.splice(index,1); //remove random item from bannersShown
				
				var banner = banners[0]; //pick first item of banners(NotShown)
				banners.shift(); //remove first item from banners(NotShown)
				
				banners.push(bannerHide); //add random item to banners(NotShown)
				bannersShown.push(banner); //add item to bannersShown
				
				var div = $("#banner" + bannerHide.Nr);
				
				//hide previous banner
				$(div).animate({opacity:0},1000,"linear",function(){
					//set new banner
					$(div)
						.attr("id","banner" + banner.Nr)		
						.css("background-image", 'url(' + "{{ URL::asset('images/banners')}}/" + banner.BannerFileName + ')')
						.on("click",function(){document.location.href = "http:////" + banner.RedirectURL;});
				});
				
				//show new photo
				$(div).animate({opacity:1},2000,"swing");
			}
				
			changeRandomBanner();
		}, 20000);
	}
	
	function arrangePhotoGrid() {
		$("#searchtext").hide();
		$("#searchonmap").hide();
		$('body').append($("#searchtext"));	
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
		
		//dedicate boxes for banners
		var bannerCounts = [];
		if (banners.length > 0) {
			bannerCounts.push(Math.floor(nrCols * nrRows * Math.random()));
		}
		if (banners.length > 1) {
			if (nrCols * nrRows >= 9) {
				var cnt = Math.floor(nrCols * nrRows * Math.random());
				while ($.inArray(cnt,bannerCounts) >= 0) {
					cnt = Math.floor(nrCols * nrRows * Math.random());
				}
				bannerCounts.push(cnt);				
			}
		}
		if (banners.length > 2) {
			if (nrCols * nrRows >= 15) {
				var cnt = Math.floor(nrCols * nrRows * Math.random());
				while ($.inArray(cnt,bannerCounts) >= 0) {
					cnt = Math.floor(nrCols * nrRows * Math.random());
				}
				bannerCounts.push(cnt);				
			}
		}
		
		var count = 0;
		var showBanner = false;
		var left = padding;
		var top = padding;
		var photoWidth = (width-padding*(nrCols+1))/nrCols;
		var photoHeight = (height-padding*(nrRows+1))/nrRows;
		
		for (col = 1; col <= nrCols; col++) {
			for (row = 1; row <= nrRows; row++) {
			
				showBanner = ($.inArray(count,bannerCounts) >= 0);
				
				(function() {
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
						var search = $("#searchtext");
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
					
					if (showBanner) {
						//add banner
						var banner = banners[0]; //pick first item of banners(NotShown)
						banners.shift(); //remove item from banners(NotShown)
						bannersShown.push(banner); //add item to bannersShown
						
						var div = document.createElement("div");
						$(div)
							.addClass("banner")
							.css("left", left + "px")
							.css("top", (top + photoTop) + "px")
							.width(photoWidth + "px")
							.height((photoHeight - photoTop - photoBottom))
							.css("background-image", 'url(' + "{{ URL::asset('images/banners')}}/" + banner.BannerFileName + ')')
							.attr("id","banner" + banner.Nr)
							.on("click",function(){document.location.href = "http:////" + banner.RedirectURL;});
						$('#photogrid').append(div);					
					} else {
						var photo = photos[0]; //pick first item of photos(NotShown)
						photos.shift(); //remove item from photos(NotShown)
						photosShown.push(photo); //add item to photoShown
						
						var colName = photo[1];
						colName += '<img src="{{ URL::asset('images/flags')}}/' + photo[3] + '.gif"></img>';

						var divHeader = document.createElement("div");
						$(divHeader)
							.addClass("photoheader")
							.css("left", left + "px")
							.css("top", (top + photoTop) + "px")
							.width(photoWidth - 10 + "px")
							.html(colName)
							.attr("id","photoheader" + photo[0])
							.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photo[0];})
							.on("mouseenter",function(){
								$("#photo" + photo[0]).css("opacity",0.4);
								$("#photoheader" + photo[0]).show();
							})
							.on("mouseleave",function(){
								$("#photo" + photo[0]).css("opacity",1.0);
								$("#photoheader" + photo[0]).hide();
							});
						$('#photogrid').append(divHeader);		
						
						var div = document.createElement("div");
						$(div)
							.addClass("photo")
							.css("left", left + "px")
							.css("top", (top + photoTop) + "px")
							.width(photoWidth + "px")
							.height((photoHeight - photoTop - photoBottom) + "px")
							.attr("id","photo" + photo[0])
							.css("background-image", 'url(' + "{{ URL::asset('images/covers')}}/" + photo[0] + ".jpg" + ')')
							.on("click",function(){document.location.href="{{ URL::asset('col')}}/" + photo[0];})
							.on("mouseenter",function(){
								$("#photo" + photo[0]).css("opacity",0.4);
								$("#photoheader" + photo[0]).show();
							})
							.on("mouseleave",function(){
								$("#photo" + photo[0]).css("opacity",1.0);
								$("#photoheader" + photo[0]).hide();
							});
						$('#photogrid').append(div);
						
					}
				})();
					
				top += photoHeight + padding;
				
				count++;
			}
			
			left += photoWidth + padding;
			top = padding;
		}
	}
</script>
@stop
