@extends('layouts.home')

@section('content')

<div class="overhome">
    <div class="homemenu">
        <div class="homelogo">
            <a href="{{ URL::asset('/') }}"><img src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
        <ul class='tabrow'>
            <a href="{{url('/')}}"><li class='selectedtab'>Home</li></a>
            <a href="{{url('/random')}}"><li>Random cols</li></a>
            <a href="{{url('/help')}}"><li>Help<i class="glyphicon glyphicon-question-sign"></i></li></a>
            <a href="{{url('/about')}}"><li>About<i class="glyphicon glyphicon-info-sign"></i></li></a>
            <!--<a id="countrytab" href="#"><li class="countrymenuitem">Countries</li></a>-->            
        </ul>
    </div>
</div>

<div class="overcontent">
    <div class="col-md-12 scenery">
        <div class='col-md-12 interaction'>
            <div class="limitsearchflag"></div>
            <form class="navbar-form" role="search">
                <div id="bloodhound" class="add-on">
                    <input type="text" class="searchfield form-control typeahead" placeholder="Search a col in Europe..." name="colid" id="searchbox">
                    <div class="input-group-btn">
                        <div class="btn btn-default search" title="Search"><i class="glyphicon glyphicon-search"></i></div>
                        <button class="btn btn-default globe" type="submit" title="Search on the map"><img src="{{ URL::asset('images/globeblack.png') }}" alt="" /></button>
                    </div>
                </div>
                <input id="colid" type="hidden" name="colid" value=""/>
            </form>
        </div>
        <div class="phototext"><a href="{{ URL::asset('col/Ventoux')}}">Visit Chasseral, Switserland</a></div>
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
                                speed: 5000 // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
                                        //prev: '#arrow_left',
                                        //next: '#arrow_right'
                            }
                        });
                    });
        </script>
    </div>    
</div>
@stop
