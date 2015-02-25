<!--<div class="overmain">-->
    <div class="homemenu">
		<div id="menuleft" class="col-md-8">
			<div class="homelogo">
				<a href="{{ URL::asset('/') }}"><img id="logo_img" src="{{ URL::asset('images/logo.png') }}" /></a>
			</div>
			<a href="{{url('/')}}"><div class="menuitem"><i class="glyphicon glyphicon-home" title="Home"></i><span class="headertext">Home</span></div></a>
			<a href="{{url('/new')}}"><div class="menuitem"><i class="glyphicon glyphicon-asterisk" title="New"></i><span class="headertext">New</span></div></a>
			<a href="{{url('/stats')}}"><div class="menuitem"><i class="glyphicon glyphicon-stats" title="Stats"></i><span class="headertext">Stats</span></div></a>
			<a href="{{url('/help')}}"><div class="menuitem"><i class="glyphicon glyphicon-question-sign" title="Help"></i><span class="headertext">Help</span></div></a>
			<a href="{{url('/about')}}"><div class="menuitem"><i class="glyphicon glyphicon-info-sign" title="About"></i><span class="headertext">About</span></div></a>
			<div id="twitter">
				<img src="{{ URL::asset('images/twitter.png') }}" title="Follow CyclingCols on twitter!"/>
			</div>
		</div>
       
		<div id="menuright" class="headersearch col-md-4">
			<div id="searchtext" class="abs">
				<input type="text" class="searchfield" placeholder="Search a col in Europe..." id="searchbox">
				<div id="searchstatus"></div>
			</div>
        </div>

    </div>
<!--</div>-->

