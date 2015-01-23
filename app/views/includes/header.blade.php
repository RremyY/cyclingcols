<div class="overmain">
    <div class="homemenu">
        <div class="homelogo">
            <a href="{{ URL::asset('/') }}"><img id="logo_img" src="{{ URL::asset('images/logo.png') }}" /></a>
        </div>
        <ul class="tabrow">
            <a href="{{url('/')}}"><li class="selectedtab"><i class="glyphicon glyphicon-home" title="Home"></i><span class="headertext">Home</span></li></a>
            <a href="{{url('/new')}}"><li><i class="glyphicon glyphicon-asterisk" title="New"></i><span class="headertext">New</span></li></a>
            <a href="{{url('/stats')}}"><li><i class="glyphicon glyphicon-stats" title="Stats"></i><span class="headertext">Stats</span></li></a>
            <!--<a href="{{url('/random')}}"><li><i class="glyphicon glyphicon-random"></i>Random Cols</li></a>-->
            <a href="{{url('/help')}}"><li><i class="glyphicon glyphicon-question-sign" title="Help"></i><span class="headertext">Help</span></li></a>
            <a href="{{url('/about')}}"><li class="about"><i class="glyphicon glyphicon-info-sign" title="About"></i><span class="headertext">About</span></li></a>
			<div id="twitter">
				<img src="{{ URL::asset('images/twitter.png') }}" title="Follow CyclingCols on twitter!"/>
			</div>           
		</ul>
       
		<div class="headersearch">
            <!--<form class="navbar-form" role="search">-->
                <div id="bloodhound" class="add-on">
                    <input type="text" class="searchfield form-control typeahead" placeholder="Search a col in Europe..." name="colid" id="searchbox">
                    <!--<div class="input-group-btn">
                        <div class="btn btn-default search" title="Search"><i class="glyphicon glyphicon-search"></i></div>
                    </div>-->
                </div>
                <input id="colid" type="hidden" name="colid" value=""/>
            <!--</form>-->
        </div>

    </div>
</div>

