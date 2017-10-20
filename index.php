<?php




 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <title>Simple Map</title>
     <meta name="viewport" content="initial-scale=1.0">
     <meta charset="utf-8">
     <style>
       /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
       #map {
         height: 100%;
       }
       /* Optional: Makes the sample page fill the window. */
       html, body {
         height: 100%;
         margin: 0;
         padding: 0;
       }
     </style>
   </head>
   <body>
     <div id="map"></div>
     <script>
     function initMap() {
       var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 4,
         center: {lat: -33, lng: 151},
         disableDefaultUI: true,
         zoomControl: true
       });
       var controlDiv = document.createElement('div');
       var myControl = new MyControl(controlDiv);
       controlDiv.index = 1;
       map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
     }
     </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxTKi67B3W71rjv7z6LOxxtkA068HgRvA&callback=initMap"
     async defer></script>
   </body>
 </html>
