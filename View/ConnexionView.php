<?php

class ConnexionView
{
    private $page;

    public function __construct()
    {
        $this->page = file_get_contents('View/html/header.html');
    }

    public function displayContent()
    {
        $this->page = str_replace('{title}', 'Cefii - Connexion', $this->page);
        $this->page .= file_get_contents('View/html/connexion.html');
        $this->displayPage();
    }

    public function displayPage()
    {
        $this->page .= file_get_contents('View/html/footer.html');
        echo $this->page;
    }

}
