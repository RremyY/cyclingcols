@extends('layouts.master')

@section('content')

<script src="{{ URL::asset('js/jail.js') }}"></script>

<div class="col-md-12">
    <div class="randomcol">
            @foreach ($imagelocations as $imagelocation)
                <div class='item'>
                    <a href="{{ URL::asset('col/chasseral')}}">
                        <img class="lazy" src="{{ URL::asset('images/dummy.gif') }}" data-src="{{ URL::asset('images/slideshow') }}/{{$imagelocation}}" alt="" />
                        <p>imagecaption</p>
                    </a>
                </div>
            @endforeach
    </div>
</div>

<script>

        $(function(){
            $('img.lazy').jail({
                effect: 'fadeIn'
            });
        });
        
        
</script>

@stop
