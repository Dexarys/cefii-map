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
		$locationTable = $this->model->getAllLocations();
		$this->view->displayContent($locationTable);
	}

	/**
	 * Modification de la Bdd
	 */
	public function insertAction() {
		$result = $this->model->insertLocation();
		$this->displayAction();
	}

	/**
	 * Modification de la Bdd
	 */
	public function updateAction() {
		$result = $this->model->updateLocation();
		$this->displayAction();
	}

	/**
	 * Ajout des champs pour modification
	 */
	public function refreshFieldsAction() {
		//$result = $this->model->updateLocation();
		$this->displayAction();
	}

	/**
	 * Suppression de coordonnées
	 */
	public function deleteAction() {
		$result = $this->model->deleteLocation();
		$this->displayAction();
	}
}

?>