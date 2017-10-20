<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>[Google Maps API] Intégrer un logo dans une Map</title>
<meta name="Author" content="NoSmoking">
<style type="text/css">
html, body {
  margin:1em 0;
  padding :0;
  font-family : Verdana;
  font-size : 0.9em;
  background-color : #F8F8F8;
}
#page {
  position:relative;
  width:800px;
  padding:0;
  margin:0 auto 1em;
  background-color:#FFF;
  border: 1px solid #B0B0FF;
  box-shadow: 0px 0px 5px 2px #C0C0C0;
  overflow:hidden;
}
#header{
  margin:1px;
  background-color:#E1E4F2;
}
#header h1{
  color:#006699;
  font-size:1.5em;
  font-style:normal;
  margin:0;
  padding:0.5em;
  text-shadow:1px 1px 0px #FFF;
}
#header span {
  float: right;
  font-size: 0.5em;
  font-style: italic;
}
.section{
  margin: 2em;
}
#cadre_carte {
  margin:0 auto;
  padding:5px;
  width:600px;
  height:600px;
  border:1px solid #888;
  border-radius:5px;
  border:1px solid #CCC;
  box-shadow: 0 2px 4px 2px #CCC;
}
#div_carte {
  height:600px;
  width:600px;
  margin:auto;
}
#map_logo{
  margin:5px;
  padding:2px;
  background:#FFF;
  box-shadow:0 2px 5px #333;
}
#map_logo img{
  display:block;
}
#map_logo:hover{
  background:#3BF;
}
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
(function(){
  function initCarte(){
    // creation de la carte
    var oMap = new google.maps.Map(document.getElementById("div_carte"),{
      'center': new google.maps.LatLng(46.80, 1.70),
      'zoom' : 6,
      'backgroundColor' : '#fff',
      'streetViewControl' : false,
      'zoomControlOptions' : {
        'style' : google.maps.ZoomControlStyle.SMALL
      },
      'mapTypeId': google.maps.MapTypeId.ROADMAP
    });
    // récup. élément du logo
    var oLogo = document.getElementById('map_logo');
    // ajout élément aux contrôles de la map
    oMap.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(oLogo);
  }
  // init lorsque la page est chargée
  google.maps.event.addDomListener(window, 'load', initCarte);
})();
</script>
</head>
<body>
<div id="page">
  <div id="header">
    <h1><span>[Google Maps API]</span>Intégrer un logo dans une Map</h1>
  </div>
  <div class="section">
    <div id="cadre_carte">
      <div id="div_carte"></div>
    </div>
  </div>
  <div style="display:none">
    <!-- le logo à ajouter -->
    <a id="map_logo" href="http://www.developpez.net/forums/f1562/webmasters-developpement-web/javascript/bibliotheques-frameworks/apis-google/">
      <img src="http://club.developpez.com/webdesign/Developpez.com/Badges/badges_dvp2.gif" alt="developpez.com">
    </a>
  </div>
</div>
</body>
</html>
