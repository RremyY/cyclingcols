@extends('layouts.home')

@section('content')
<div class="col-md-2 countries">
    <div class="logohomesearch">
        <a href="{{ URL::asset('/') }}"><img src="{{ URL::asset('images/logo.png') }}" /></a>
    </div>
    <div id="thecountries" class="thecountries">
        @foreach ($countries as $country)
        <div class="country">
            <img src="{{ URL::asset('images/flags') }}/{{$country}}.gif" class="flag"/>
            <a href="#" title="Limit search to cols in {{$country}}" alt="Cols in {{$country}}" class="countryurl" onclick="countryclick(this.text);">{{$country}}</a>
            <a id="globe" href="{{ URL::asset('/') }}country/{{$country}}"><img class="globeicon" src="{{ URL::asset('images/globe.png') }}" title="View in googlemaps" /></a>
            
        </div>
        @endforeach
    </div>
</div>

<div class="col-md-10 scenery">
    <div class='interaction'>
        <a href="" class='navarrow' id="arrow_left"><img src="{{ URL::asset('images/arrow_left.png') }}" alt="Slide Left" /></a>
        <div class="limitsearchflag"></div>
        <form class="navbar-form" role="search">
            <div class="add-on">
                <input type="text" class="searchfield form-control typeahead" placeholder="Search a col in Europe.." name="srch-term" id="searchbox">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>

        <a href="" class='navarrow' id="arrow_right"><img src="{{ URL::asset('images/arrow_right.png') }}" alt="Slide Right" /></a>                

    </div>
    <div class="phototext"><a href="{{ URL::asset('col/chasseral')}}">Visit Chasseral, Switserland</a></div>
    <div id="maximage">
        <img src="{{ URL::asset('images/slideshow/Italy/P6170155.JPG') }}" alt="" />	
        <img src="{{ URL::asset('images/slideshow/Spain/P3020093.JPG') }}" alt="" />
        <img src="{{ URL::asset('images/slideshow/Spain/P3020096.JPG') }}" alt="" />
        <img src="{{ URL::asset('images/slideshow/Spain/P3020102.JPG') }}" alt="" />
    </div>

    <script type="text/javascript" charset="utf-8">
    $(function() {
        // Trigger maximage
        $('#maximage').maximage({
            cycleOptions: {
                fx: 'fade',
                speed: 5000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
                prev: '#arrow_left',
                next: '#arrow_right'
            }
        });
    });
    </script>
</div>    
@stop
