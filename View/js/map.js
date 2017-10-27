var map; // @param map - Variable de la map
var logo = new Image(); // @param logo - Initialisation de l'objet image pour intégrer le logo
var markerArray = []; // @param markerArray - Tableau contenant les marqueurs
var marker; // @param marker - Marqueur
var france = {lat: 47.4666700,lng: -0.5500000};
var europe = {lat: 48.1045601,lng: 4.1834218};
var world = {lat: 20.4165000,lng: -0.5500000};


// Initialisation de la map - API Google
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: 47.4666700, lng: -0.5500000},
    disableDefaultUI: true,
    zoomControl: true,
    mapTypeId: 'satellite',
    fullscreenControl: true
  });

  // Ajout des données
  downloadUrl("View/marker.xml", function(data) { // modifier l'url par le fichier xml correspodant aux données
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('marker');
    Array.prototype.forEach.call(markers, function(markerElem) {
      var point = new google.maps.LatLng(
          parseFloat(markerElem.getAttribute('lat')),
          parseFloat(markerElem.getAttribute('lng')));

      var images = { // @param images - Modification du marqueur par défaut - Ne gère pas le regroupemement des marqueurs
        url: 'View/img/logo-marqueur.png',
        size: new google.maps.Size(64,64),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 0)
      };

      marker = new google.maps.Marker({
        map: map,
        icon: images, // Pour changer le marqueur
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

  var franceControlDiv = document.createElement('div');
  var franceControl = new FranceZoom(franceControlDiv, map);

  franceControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(franceControlDiv);


  var europeControlDiv = document.createElement('div');
  var europeControl = new EuropeZoom(europeControlDiv, map);

  europeControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(europeControlDiv);

  var worldControlDiv = document.createElement('div');
  var worldControl = new WorldZoom(worldControlDiv, map);

  worldControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(worldControlDiv);

}

// Création du logo permettant la redirection vers la page d'administration
function RedirectCefii(controlDiv, map) {
  var controlLogo = document.createElement('div');
  logo.style.cursor = 'pointer';
  logo.src = 'View/img/logo.png';
  logo.style.width = '100px';
  logo.style.height = '100px';
  logo.style.margin = '10px';
  controlLogo.appendChild(logo);
  controlDiv.appendChild(controlLogo);
  controlLogo.addEventListener('click', function() {
    document.location.href="index.php?page=admin&action=display";
  })
}

// Création des racourcis pour le zoom
function FranceZoom(controlDiv, map) {
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#fff';
  controlUI.style.border = '2px solid #fff';
  controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '22px';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Click to recenter the map';
  controlUI.style.margin = '2px';
  controlDiv.appendChild(controlUI);

  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(25,25,25)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '16px';
  controlText.style.lineHeight = '38px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'France';
  controlUI.appendChild(controlText);

  controlUI.addEventListener('click', function() {
     map.setCenter(france);
     map.setZoom(7);
  });
}

function EuropeZoom(controlDiv, map) {
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#fff';
  controlUI.style.border = '2px solid #fff';
  controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '22px';
  controlUI.style.textAlign = 'center';
  controlUI.style.margin = '2px';

  controlUI.title = 'Click to recenter the map';
  controlDiv.appendChild(controlUI);

  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(25,25,25)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '16px';
  controlText.style.lineHeight = '38px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'Europe';
  controlUI.appendChild(controlText);

  controlUI.addEventListener('click', function() {
     map.setCenter(europe);
     map.setZoom(5);
  });
}

function WorldZoom(controlDiv, map) {
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#fff';
  controlUI.style.border = '2px solid #fff';
  controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '22px';
  controlUI.style.textAlign = 'center';
  controlUI.style.margin = '2px';

  controlUI.title = 'Click to recenter the map';
  controlDiv.appendChild(controlUI);

  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(25,25,25)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '16px';
  controlText.style.lineHeight = '38px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'Monde';
  controlUI.appendChild(controlText);

  controlUI.addEventListener('click', function() {
     map.setCenter(world);
     map.setZoom(3);
  });
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
