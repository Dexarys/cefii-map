<?php

include "Model/ConnexionModel.php";
include "View/ConnexionView.php";

class ConnexionController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new ConnexionModel();
        $this->view = new ConnexionView();
    }

    /**
	 * Affichage du formulaire de connexion
	 */
    public function displayAction()
    {
        if ($this->model->login_check() === false) {
            $this->view->displayContent();
        } else {
            header('Location: index.php?page=admin&action=display');
        }
    }

    /**
	 * Connexion
	 */
    public function connexionAction()
    {
        $try = $this->model->login();
        if ($try === true) {
            header('Location: index.php?page=admin&action=display');
        } else {
            header('Location: index.php?page=connexion&action=display&error=true');
        }
    }

    /**
	 * Deconnexion
	 */
    public function deconnexionAction()
    {
        $this->model->logout();
    }

}
