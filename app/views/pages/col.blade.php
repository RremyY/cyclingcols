@extends('layouts.master')

@section('content')
<div class="colpage">
    <div class="colimage" style='background-image: 
         url( {{URL::asset("images/cols/chasseral/P1010004.JPG") }} );'>
    </div>
    <div class="coltitlesection">
        <div class="col-md-2">
            <div class='prevbutton'>

                <i class="glyphicon glyphicon-arrow-left"></i>
                <p>previous col in Switzerland (Alfabetic)</p>

            </div>
        </div>
        <div class="col-md-6 coltitle">
            <h3><img src="{{ URL::asset('images/flags/Switzerland.gif') }}"/> Switzerland, Wallis/ Valais </h3>
            <h1>Colle del Gran San Bernardo</h1>
            <h3><img src="{{ URL::asset('images/flags/Italy.gif') }}"> Italy, Val d’Aoste/ Valle d’Aoste </h3>
            <h1>Col du Grand-Saint-Bernard</h1>
        </div>

        <div class="col-md-2 altitude">
            <div class="altitudetext"><h1>2473m</h1></div>
            <div class="altitudesign">
                <img src="{{ URL::asset('images/cols/chasseral/Chasseral.jpg') }}" />
            </div>
        </div>

        <div class="col-md-2">
            <div class='nextbutton'>

                <p>next col in Switzerland (Alfabetic)</p>
                <i class="glyphicon glyphicon-arrow-right"></i>

            </div>
        </div>    
    </div>

    <div class="col-md-12 nrprofiles">
        <p>2 profiles: North (from Martigny), South (from Aosta/ Aoste)</p>
    </div>

    <div class="profileinfo">
        <div class="col-md-8 leftinfo">
            <div class="col-lg-6">
                <div id="profile1" class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-10">Colle del Gran San Bernardo/ Col du Grand-Saint-Bernard <strong>North</strong> (from Martigny)</h4>
                        <div class="col-xs-2">
                            <div class="category hc">HC</div>
                        </div>
                    </div>

                    <div class="col-sm-12 profileimage" style='background-image:url("{{ URL::asset('images/cols/chasseral/ChasseralN.gif') }}")'>
                         <p>Distance   <span style="background-color:red;">13km</span>  </p>
                        <p>Climbing Altitude   <span style="background-color:orange;">865m</span>   </p>
                        <p>Average grade   <span style="background-color:orange;">6,8%</span></p>
                        <p>Max grade   <span style="background-color:yellow;">11,5%</span></p>
                        <p>Profile Index   <span style="background-color:red;">809</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="profile2" class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-10">Colle del Gran San Bernardo</h4>
                        <div class="col-xs-2">
                            <div class="category first">1</div>
                        </div>
                    </div>
                    <div class="col-sm-12 profileimage" style='background-image:url("{{ URL::asset('images/cols/chasseral/ChasseralSE.gif') }}")'>
                         <p>Distance   <span style="background-color:red;">13km</span></p>
                        <p>Climbing Altitude   <span style="background-color:orange;">865m</span></p>
                        <p>Average grade   <span style="background-color:orange;">6,8%</span></p>
                        <p>Max grade   <span style="background-color:yellow;">11,5%   </span></p>
                        <p>Profile Index   <span style="background-color:red;">809</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="profile3" class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-10">Colle del Gran San Bernardo/ Col du Grand-Saint-Bernard <strong>North</strong> (from Martigny)</h4>
                        <div class="col-xs-2">
                            <div class="category hc">HC</div>
                        </div>
                    </div>
                    <div class="col-sm-12 profileimage" style='background-image:url("{{ URL::asset('images/cols/chasseral/ChasseralSW.gif') }}")'>
                         <p>Distance   <span style="background-color:red;">13km</span></p>
                        <p>Climbing Altitude   <span style="background-color:orange;">865m</span></p>
                        <p>Average grade   <span style="background-color:orange;">6,8%</span></p>
                        <p>Max grade   <span style="background-color:yellow;">11,5%   </span></p>
                        <p>Profile Index   <span style="background-color:red;">809</span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div id="profile4" class="profile">
                    <div class="profiletitle">
                        <h4 class="col-xs-10">Colle del Gran San Bernardo/ Col du Grand-Saint-Bernard <strong>North</strong> (from Martigny)</h4>
                        <div class="col-xs-2">
                            <div class="category first">1</div>
                        </div>
                    </div>
                    <div class="col-sm-12 profileimage" style='background-image:url("{{ URL::asset('images/cols/chasseral/ChasseralW.gif') }}")'>
                         <p>Distance   <span style="background-color:red;">13km</span></p>
                        <p>Climbing Altitude   <span style="background-color:orange;">865m</span></p>
                        <p>Average grade   <span style="background-color:orange;">6,8%</span></p>
                        <p>Max grade   <span style="background-color:yellow;">11,5%   </span></p>
                        <p>Profile Index   <span style="background-color:red;">809</span></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 rightposition">
            <div class="rightinfo">
                <div class="colmaps">
                    <iframe width="100%" height="400px" frameborder="0" style="border:0" 
                            src="https://www.google.com/maps/embed/v1/place?q=chasseral&key=AIzaSyAygOiuwB64V3LNNXX5i6p-gRArxV1-P94"></iframe>
                </div>
                <div class="support">
                    <h3>Support Cyclingcols</h3>
                </div>
                <div class="profs">
                    <h3>First on top in professional Cycling</h3>
                </div>            
                <div class="randomimage">
                    <h3>Random Image</h3>
                    <img src="{{ URL::asset('images/cols/chasseral/P1010006.JPG') }}"/>
                </div>
            </div>
        </div>
    </div>


</div>
@stop
