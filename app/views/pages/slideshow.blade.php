@extends('layouts.master')

@section('content')

<script type="text/javascript">
	/*sets the height of the map-canvas so that it always fills the screen height*/
	function calculateslideshowheight() {
		if ($('body').hasClass('slideshowpage')) {
			$h = $(window).height() - $('.footer').height() - $('.overmain').height() - $('#no-template-pager').height() - $('#back').height() - 15;
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

<div id="slideshow_back">Go back to <a href="../col/{{$col->ColIDString}}">{{$col->Col}}</a></div>
<div id="slideshow" class="cycle-slideshow"
	data-cycle-fx=scrollHorz
	data-cycle-timeout=0
	data-cycle-center-vert=true
	data-cycle-center-horz=true
	data-cycle-pager="#no-template-pager"
	data-cycle-pager-template=""
	>

    <img class="slide" src="{{URL::asset('images/cols/tauernmoossee/287.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/288.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/289.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/290.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/291.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/292.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/293.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/294.JPG') }}">
	<img class="slide" src="{{URL::asset('images/cols/tauernmoossee/295.JPG') }}">
</div>
<div id=no-template-pager class="cycle-pager external" style="padding: 5px;text-align: center;">
	<!-- using thumbnail image files would be even better! -->
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/287.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/288.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/289.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/290.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/291.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/292.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/293.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/294.JPG') }}" width=30 height=30>
	<img src="{{URL::asset('images/cols/tauernmoossee/thumbnails/295.JPG') }}" width=30 height=30>
</div>

<script type="text/javascript">
	$('.slide').click(function() {
		$('.cycle-slideshow').cycle('next');
	});
</script>
@stop
