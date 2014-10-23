@extends('layouts.master')

@section('content')

<script src="{{ URL::asset('js/masonry.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/jail.js') }}"></script>



<div class="col-md-12">
    <div id="colmasonry" class="randomcol">
        <div class="gutter-sizer"></div>
            @foreach ($imagelocations as $imagelocation)
                <div class='item'>
                    <a href="{{ URL::asset('col/chasseral')}}">
                        <img class='lazy' src="{{ URL::asset('images/slideshow') }}/{{$imagelocation}}" alt="" />
                        <p>imagecaption</p>
                    </a>
                </div>
            @endforeach
    </div>
</div>

<script>
    
var $mywidth = $('#colmasonry .item').width();
var $container = $('#colmasonry');

// initialize Masonry after all images have loaded  
$container.imagesLoaded( function() {
  $container.masonry({
          "itemSelector": ".item",
          "columnWidth": $mywidth,
          "gutter": ".gutter-sizer"
  });
});


</script>

@stop
