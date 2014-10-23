@extends('layouts.master')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<div class="googlemaps">
    <!--
<iframe width="100%" height="100%" frameborder="0" style="border:0" 
        src="https://www.google.com/maps/embed/v1/place?q={{$selectedcountry}}&key=AIzaSyAygOiuwB64V3LNNXX5i6p-gRArxV1-P94"></iframe>
</div>-->

<div id="map-canvas" style="height:80%"></div>

<script>

    function initialize() {
        

        var coords = [];
        coords.push([new google.maps.LatLng(27.914176,-15.688296)], "Paso de Tauro");
        coords.push([new google.maps.LatLng(27.929729,-15.598041)], "Paso de la Herradura");
        

        //mapscanvas();
   
        //set the project location
        var myLatlng = new google.maps.LatLng(27.915755,-15.574403);
        var map = new google.maps.Map(document.getElementById("map-canvas"), {
            // Algemene opties kaartje //
            zoom: 10,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            maxWidth: 300,
            streetViewControl: false
        });
        

        for (i = 0; i < coords.length; i++) {
            
            var str = coords[i][0];
            var substr = str.split(',');
            var partnerLatlng = new google.maps.LatLng(substr[0], substr[1]);
            
            var marker;
            marker = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: myLatlng
            });
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    

</script>

@stop
