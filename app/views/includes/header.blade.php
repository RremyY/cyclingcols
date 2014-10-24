

<div class="col-sm-12 mainheader">

    <div class="col-sm-2">
        <div class="logoheader">
            <a href="{{ URL::asset('/') }}"><img src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
    </div>


    <div class="col-sm-5 menu">
        <ul class='tabrow'>
            <a href="{{url('/')}}"><li class='selectedtab'>Home</li></a>
            <a id="countrytab" href="#"><li class="countrymenuitem">Countries</li></a>
            <a href="{{url('/random')}}"><li>Random cols</li></a>
            <a href="{{url('/help')}}"><li>Help <i class="glyphicon glyphicon-question-sign"></i></li></a>
            <a href="{{url('/about')}}"><li>About <i class="glyphicon glyphicon-info-sign"></i></li></a>
        </ul>
    </div>
    <div class="col-sm-5">
        <div class="limitsearchflag"></div>
        <form class="navbar-form add-on" role="search">
            <div class="add-on">
                <input type="text" class="searchfield form-control typeahead" placeholder="Search a col in Europe.." name="srch-term" id="searchbox">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>

    </div>


</div>

