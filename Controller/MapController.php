<?php

include "Model/MapModel.php";
include "View/MapView.php";

class MapController {

  private $view;
  // private $model;

  public function __construct() {
    $this->view = new MapView();
  }

  public function displayAction() {
    $this->view->displayContent();
  }

}


 ?>
