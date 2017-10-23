var map; // @param map - Variable de la map
var logo = new Image(); // @param logo - Initialisation de l'objet image pour intégrer le logo
var markerArray = []; // @param markerArray - Tableau contenant les marqueurs
var marker; // @param marker - Marqueur


// Initialisation de la map - API Google
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {lat: -33, lng: 151},
    disableDefaultUI: true,
    zoomControl: true
  });

  // Ajout des données
  downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('marker');
    Array.prototype.forEach.call(markers, function(markerElem) {
      var point = new google.maps.LatLng(
          parseFloat(markerElem.getAttribute('lat')),
          parseFloat(markerElem.getAttribute('lng')));

      marker = new google.maps.Marker({
        map: map,
        position: point
      });
      markerArray.push(marker);
    });
    var markerCluster = new MarkerClusterer(map, markerArray, {imagePath: 'View/img/m'});
  });



  var redirectCefiiDiv = document.createElement('div');
  var redirectCefii = new RedirectCefii(redirectCefiiDiv, map);

  redirectCefiiDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(redirectCefiiDiv);
}

// Création du logo permettant la redirection vers la page d'administration
function RedirectCefii(controlDiv, map) {
  var controlLogo = document.createElement('div');
  logo.style.cursor = 'pointer';
  logo.src = 'View/img/logo.png';
  logo.style.width = '100px';
  logo.style.height = '100px';
  controlLogo.appendChild(logo);
  controlDiv.appendChild(controlLogo);
  controlLogo.addEventListener('click', function() {
    document.location.href="#";
  })
}


// Récupération des données XML obtenue à partir de la base de données
function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}
