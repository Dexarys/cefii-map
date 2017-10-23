<?php

class Dispatcher {
  private $get;
  private $page;
  private $action;

  public function __construct() {
    $this->get = $_GET;
  }

  public function dispatch() {
    $this->extractParam();
    $this->executeAction();
  }

  private function extractParam() {
    $this->page = array_key_exists('page', $this->get)?$this->get['page']:DEFAULT_CONTROLLER;
    $this->action = array_key_exists('action', $this->get)?$this->get['action']:DEFAULT_ACTION;
  }

  private function executeAction() {

    $controller = ucfirst($this->page).'Controller';
    $file = "Controller/".$controller.".php";
    $action = $this->action."Action";
    if (file_exists($file)) {
      require $file;
      if (method_exists($controller, $action)) {
        $this->controller = new $controller();
        $this->controller->$action();
      } else {
        $this->redirection();
      }
    } else {
      $this->redirection();
    }
  }

  private function redirection() {
    header('Location:index.php?page=error&action=error404');
    exit();
  }

}



 ?>
