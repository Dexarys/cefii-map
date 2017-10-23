<?php

class MapView {

  private $page;

  public function __construct() {
    $this->page = file_get_contents("View/html/map.html");
  }

  public function displayContent() {
    // $this->page = str_replace('{title}', 'Google Map', $this->page);
    // $this->page .= file_get_contents("View/html/map.html");
    $this->displayPage();
  }

  public function displayPage() {
    // $this->page .= file_get_contents("View/html/footer.html");
    echo $this->page;
  }
}


 ?>
