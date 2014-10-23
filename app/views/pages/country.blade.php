@extends('layouts.master')

@section('content')
<div class="googlemaps">
<iframe width="100%" height="100%" frameborder="0" style="border:0" 
        src="https://www.google.com/maps/embed/v1/place?q={{$selectedcountry}}&key=AIzaSyAygOiuwB64V3LNNXX5i6p-gRArxV1-P94"></iframe>
</div>
@stop
