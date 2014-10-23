@extends('layouts.master')

@section('content')
<div clas="col-md-12">
    <div class="plaintext">
    <h1>
        Cyclingcols Help
    </h1>
        <p>This page will help explain the graphs of a col. As an example image we use La berarde, a col of 27,3 km length in France.</p>
    
        <img src="{{ URL::asset('images/cols/berarde/Berarde.gif') }}"/>
        
        <h1>Legend</h1>
        <ul>
            <li>Distance in km</li>
            <li>Average grade</li>
            <li>Altitude</li>
            <li>Tunnel</li>
            <li>Steepest kilometer</li>
        </ul>
            
        
    </div>
</div>
@stop
