<?php
class AdminView {

	private $page;

	/**
	 * Constructeur : ajout du header et de la nav dans l'attribut page
	 */
	public function __construct() {
		$this->page  = file_get_contents("view/html/header.html");
	}

	/**
	 * Affichage du formulaire d'ajout ou de modification
	 * @return [string] [description]
	 */
	public function fillForm() {
		$action		= isset($_GET['action'])?$_GET['action']:"";

		if($action == 'delete'){
			$action = 'insert';
		}

		$postcode 	= isset($_GET['postcode'])?$_GET['postcode']:"";
		$city    	= isset($_GET['city'])?$_GET['city']:"";
		$country 	= isset($_GET['country'])?$_GET['country']:"";

		$content 	= file_get_contents("view/html/admin.html");
		$content 	= str_replace('{action}', $action, $content);
		$content 	= str_replace('{postcode}', $postcode, $content);
		$content 	= str_replace('{city}', $city, $content);
		$content 	= str_replace('{country}', $country, $content);

		$this->page .= $content;
	}

	/**
	 * Affichage du texte reçu par paramètre
	 * @param  [string] $text [texte]
	 * @return [string]       [description]
	 */
	public function displayContent($table) {

		$this->fillForm();

		if ($table) {
			$out  = "<h2>Liste des coordonnées disponibles</h2>";
			$out .= '<div class="table-responsive"><table class="table table-striped table-bordered cellspacing="0" border=1>'
					. '<thead>'
					. '<th>CP</th><th>Ville</th><th>Pays</th><th>Latitude</th><th>Longitude</th><th>Modifier</th><th>Supprimer</th>'
					. '</thead>'
					. '<tbody>';
			foreach($table as $element) {
				$out .= "<tr>";
				$out .= "<td>".$element['postcode']."</td>";
				$out .= "<td>".$element['city']."</td>";
				$out .= "<td>".$element['country']."</td>";
				$out .= "<td>".$element['latitude']."</td>";
				$out .= "<td>".$element['longitude']."</td>";
				$out .= "<td><a href='index.php?page=Admin&action=update&id=".$element['locationid']."'><button>Modifier</button></a></td>";
				$out .= "<td><a href='index.php?page=Admin&action=delete&id=".$element['locationid']."'><button>Supprimer</button></a></td>";
			}
			$out .=  "</tbody></table></div>";	
		}
		else {
			$out =  "<h2>Aucune donnée</h2>";	
		}

		$this->page .= $out;
		$this->displayPage();
	}

	/**
	 * Affiche l'ensemble de la page
	 * Inclusion du footer
	 * @return [string] [description]
	 */
	private function displayPage(){
		$this->page .= file_get_contents("view/html/footer.html");
		echo $this->page;
	}
}