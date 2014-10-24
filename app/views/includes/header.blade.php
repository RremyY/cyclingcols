

<div class="col-sm-12 mainheader">

    <div class="col-sm-2">
        <div class="logoheader">
            <a href="{{ URL::asset('/') }}"><img src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
    </div>


    <div class="col-sm-5 menu">
        <ul class='tabrow'>
            <li class='selectedtab'><a href="{{url('/')}}">Home</a></li>
            <li class="countrymenuitem"><a id="countrytab" href="#">Countries</a></li>
            <li><a href="{{url('/random')}}">Random cols</a></li>
            <li><a href="{{url('/help')}}">Help <i class="glyphicon glyphicon-question-sign"></i></a></li>
            <li><a href="{{url('/about')}}">About <i class="glyphicon glyphicon-info-sign"></i></a></li>
        </ul>
    </div>
    <div class="col-sm-5">
        <div class="limitsearchflag"></div>
        <form class="navbar-form" role="search">
            <div class="input-group add-on">
                <input type="text" class="searchfield form-control" placeholder="Search a col in Europe.." name="srch-term" id="searchbox">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
    </div>


</div>

