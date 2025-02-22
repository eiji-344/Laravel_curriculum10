<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <title>Map</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  </head>
  <body>
	   <div id="map" style="height:500px">
	   </div>
     @foreach ($addresses as $address)
        <div class="address" style="display: none;">{{ $address }}</div>
      @endforeach
     <script src="{{ asset('/js/result.js') }}"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
  </body>
</html>