@extends('dashboard.blank')

@section('page_title', 'Locaties')

@section('content')
    <div id="map"></div>
        <script>
            function initMap() {
                var Nederland = {lat: 52.14611856, lng: 5.31323866};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: Nederland
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }

            $(document).ready(function() {
                $(window).resize(function() {
                    google.maps.event.trigger(map, 'resize');
                });
                google.maps.event.trigger(map, 'resize');
            });
        </script>
@endsection