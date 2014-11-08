@extends('layouts.home')

@section('content')

<div class="overhome">
    <div class="homemenu">
        <div class="homelogo">
            <a href="{{ URL::asset('/') }}"><img src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
        <ul class='tabrow'>
            <a href="{{url('/')}}"><li class='selectedtab'>Home</li></a>
            <a href="{{url('/random')}}"><li>Random Cols</li></a>
            <a href="{{url('/help')}}"><li>Help<i class="glyphicon glyphicon-question-sign"></i></li></a>
            <a href="{{url('/about')}}"><li>About<i class="glyphicon glyphicon-info-sign"></i></li></a>
            <!--<a id="countrytab" href="#"><li class="countrymenuitem">Countries</li></a>-->            
        </ul>
    </div>
</div>

<div class="overcontent">
    <div class="col-md-12 scenery" style="padding:0px">
        <div class='col-md-12 interaction'>
            <div class="limitsearchflag"></div>
            <form class="navbar-form" role="search">
                <div id="bloodhound" class="add-on">
                    <input type="text" class="searchfield form-control typeahead" placeholder="Search a col in Europe..." name="colid" id="searchbox" style="z-index:1000">
                    <div class="input-group-btn">
                        <div class="btn btn-default search" title="Search"><i class="glyphicon glyphicon-search"></i></div>
                        <a href="{{url('/map')}}"><div class="btn btn-default globe" type="submit" title="Display map"><img src="{{ URL::asset('images/globeblack.png') }}" alt="" /></div></a>
                    </div>
                </div>
                <input id="colid" type="hidden" name="colid" value=""/>
            </form>
        </div>
        <div id="phototext" class="phototext" style="z-index:1000"><a href=""></a></div>
        <div id="slide" style="margin:0px;width: 100%;height:800px;background-repeat:no-repeat">
        </div>

        <script type="text/javascript" charset="utf-8">
			var images;

			function showSlide(images,nr) {
				setSlide("{{ URL::asset('images/covers')}}/" + images[nr][0] + ".jpg","{{ URL::asset('col')}}/" + images[nr][0],images[nr][1]);
				if (nr<images.length-1) {
					setTimeout(function(){showSlide(images,nr+1)},5000);
				}
			}
			
			setSlide = function(slide_url,href,colname) {
				console.log(slide_url);
				//$("#slide").css("background-image",  "url('" + slide_url + "')");
				//$("#slide").css("background-position",  "30%");
				setTimeout(function(){$("#phototext a").attr("href",href)},500);//$("#phototext a").attr("href",href);
				setTimeout(function(){$("#phototext a").text("Visit " + colname);},500);//$("#phototext a").text("Visit " + colname);
				$("#slide").backstretch(slide_url, {fade: 750});
			}
			
			$.ajax({
				url : "{{ URL::asset('ajax/getphotos.php') }}",
				data : "",
				dataType : 'json',
				success : function(data) {
					images = data;
				
					//init();
					showSlide(images,0);
				}
			})

			function calculateslideshowheight() {
				$h = $(window).height() - $('.footer').height() - $('.overmain').height();
				$('#slide').height($h);
			}
			
			$(document).ready(function() {
				calculateslideshowheight();
			});
			
			$(window).resize(function() {
				calculateslideshowheight(); 
			});

        </script>
    </div>    
</div>
@stop
