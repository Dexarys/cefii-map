<?php
include "Model/AdminModel.php";
include "View/AdminView.php";

class AdminController {

	private $view;
	private $model;

	public function __construct() {
		$this->view = new AdminView();
		$this->model = new AdminModel();
	}

	/**
	 * Affichage des coordonnées
	 */
	public function displayAction() {
        if ($this->model->login_check()) {
            $locationTable = $this->model->getAllLocations();
            $this->view->displayContent($locationTable);
        } else {
            header('Location: index.php?page=connexion&action=display');
        }
	}

	/**
	 * Modification de la Bdd
	 */
	public function insertAction() {
        if ($this->model->login_check()) {
            $result = $this->model->insertLocation();
        }
		$this->displayAction();
	}

	/**
	 * Modification de la Bdd
	 */
	public function updateAction() {
        if ($this->model->login_check()) {
            $result = $this->model->updateLocation();
        }
		$this->displayAction();
	}

	/**
	 * Ajout des champs pour modification
	 */
	public function refreshFieldsAction() {
		$this->displayAction();
	}

	/**
	 * Suppression de coordonnées
	 */
	public function deleteAction() {
        if ($this->model->login_check()) {
            $result = $this->model->deleteLocation();
        }
		$this->displayAction();
	}
}

?>
