@extends('layouts.master')

@section('content')

<script type="text/javascript">
	/*sets the height of the map-canvas so that it always fills the screen height*/
	function calculateslideshowheight() {
		//if ($('body').hasClass('slideshowpage')) {
		alert("test");
			$('#slideshow').height(($('.footer').offset().top) - ($('#slideshow').offset().top));
		//}
	}
	
	$(document).ready(function() {
		calculateslideshowheight();
	});
	
	$(window).resize(function() {
		calculateslideshowheight(); 
	});
</script>

<div id="slideshow">
	<div class="cycle-slideshow" 
		data-cycle-fx=scrollHorz
		data-cycle-timeout=0
		data-cycle-pager="#no-template-pager"
		data-cycle-pager-template=""
		>
		<img src="{{URL::asset('images/cols/chasseral/P1010002.JPG') }}">
		<img src="{{URL::asset('images/cols/chasseral/P1010004.JPG') }}">
		<img src="{{URL::asset('images/cols/chasseral/P1010006.JPG') }}">
	</div>
	<div id=no-template-pager class="cycle-pager external">
		<!-- using thumbnail image files would be even better! -->
		<img src="{{URL::asset('images/cols/chasseral/P1010002.JPG') }}" width=20 height=20>
		<img src="{{URL::asset('images/cols/chasseral/P1010004.JPG') }}" width=20 height=20>
		<img src="{{URL::asset('images/cols/chasseral/P1010006.JPG') }}" width=20 height=20>
	</div>
</div>

@stop
