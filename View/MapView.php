<?php

class MapView
{
    private $page;

    public function __construct()
    {
        $this->page = file_get_contents("View/html/map.html");
    }

    public function displayContent()
    {
        $this->displayPage();
    }

    public function displayPage()
    {
        echo $this->page;
    }
}
