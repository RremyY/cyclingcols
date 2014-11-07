@extends('layouts.master')

@section('content')

<div id="slideshow_back">Go back to <a href="../col/{{$col->ColIDString}}">{{$col->Col}}</a></div>
<div id="slideshow" class="cycle-slideshow"
	data-cycle-fx=scrollHorz
	data-cycle-timeout=0
	data-cycle-center-vert=true
	data-cycle-center-horz=true
	data-cycle-pager="#no-template-pager"
	data-cycle-pager-template=""
	>
@foreach($images as $image)
    <!--<img class="slide" src="{{URL::asset('images/cols/' . $col->ColIDString . '/' . $image->URL .'.JPG') }}">-->
	<img class="slide" src="http://www.cyclingcols.com/photos/{{$image->URL}}.jpg">
@endforeach
</div>
<div id=no-template-pager class="cycle-pager external" style="padding: 5px;text-align: center;">
@foreach($images as $image)
    <img src="http://www.cyclingcols.com/photos/{{str_replace('/','/small/',$image->URL)}}.jpg" height="30" width="30">
@endforeach
</div>

<script type="text/javascript">
	/*sets the height of the map-canvas so that it always fills the screen height*/
	function calculateslideshowheight() {
		if ($('body').hasClass('slideshowpage')) {
			$h = $(window).height() - $('.footer').height() - $('.overmain').height() - $('#no-template-pager').height() - $('#back').height() - 35;
			$hi = $h - 20; 
			$('#slideshow').height($h);
			$('.slide').height($hi);
		}
	}
	
	$(document).ready(function() {
		calculateslideshowheight();
	});
	
	$(window).resize(function() {
		calculateslideshowheight(); 
	});

</script>

<script type="text/javascript">
	$('.slide').click(function() {
		$('.cycle-slideshow').cycle('next');
	});
</script>
@stop
