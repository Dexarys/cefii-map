<?php

include "Model/MapModel.php";
include "View/MapView.php";

class MapController
{
  private $view;
  private $model;


  /**
   * Constructeur de MapController
   * @return [object] [description]
   */
  public function __construct()
  {
    $this->view = new MapView();
    $this->model = new MapModel();
    $this->xmlMarkers($this->model->getMarkers());
  }

  /**
   * Affichage des coordonnées
   */
  public function displayAction()
  {
    $this->view->displayContent();
  }


  /**
   * Méthode xmlMarkers
   * Ecris les données récupéré par le model dans un fichier xml
   */
  public function xmlMarkers($table)
  {
    $dom = new DOMDocument();
    $xml = 'View/marker.xml';
    $dom->load($xml);

    $node = $dom->documentElement;
    $markers = $dom->getElementsByTagName('marker');
   
    $count = $node->childNodes->length;

    if($count > 0){
      for($i = 0; $i < $count; $i++){
        $node->removeChild($node->childNodes->item(0));
      }
    }

    $parnode = $dom->appendChild($node);

    foreach ($table as $element) {
      $node = $dom->createElement('marker');
      $newnode = $parnode->appendChild($node);
      $newnode->setAttribute('lat', $element['latitude']);
      $newnode->setAttribute('lng', $element['longitude']);
    }
    $dom->save($xml);
  }
}
