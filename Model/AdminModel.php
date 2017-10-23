<?php

class AdminModel {
	private $connexion;

	/**
	 * Constructeur du modèle
	 * @return [object] [description]
	 */
	public function __construct() {
		$this->connectDb();
	}

	/**
	 * Verification de la zone
	 * Retourne de la valeur de la zone
	 * sinon retourne null
	 * @return [string] [description]
	 */
	private function checkZone($zone){
		return isset($zone)?$zone:null;
	}

	/**
	 * Connexion à la Bdd
	 * @return [object] [description]
	 */
	private function connectDb() {
		// define('SERVER',"sqlprive-pc2372-001.privatesql.ha.ovh.net");
		// define('USER',"cefiidev593");
		// define('PASSWORD',"oT93qA9v");
		// define('BASE',"cefiidev593");

		define('SERVER'     ,"localhost");
	    define('USER'       ,"root");
	    define('PASSWORD'	,"");
	    define('BASE'       ,"projet_007");

	    $this->connexion = false;
		
		try
		{
			$this->connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);
			$this->connexion->exec('SET NAMES utf8');
		}
		catch (Exception $e)
		{
			echo 'Erreur : ' . $e->getMessage();
		}
	}


	public function getAllLocations() {
		$table = array(); // variable vide en cas d'erreur
		if ($this->connexion) {
			$requete 	= "SELECT * FROM student_location";
			$resultat   = $this->connexion->query($requete);
			
			if ($resultat) {
				$table = $resultat->fetchAll(PDO::FETCH_ASSOC);
			}
		}

		return $table;
	}

	public function insertLocation() {
		$postcode 	= $this->checkZone($_POST["postcode"]);
		$city     	= $this->checkZone($_POST["city"]);
		$country	= $this->checkZone($_POST["country"]);	
		$latitude	= null;
		$longitude	= null;

		$result 	= false;

		if ($this->connexion) {
			$req = $this->connexion->prepare("INSERT INTO student_location VALUES (NULL, :postcode, :city, :country, :latitude, :longitude)");

			$req->bindParam(':postcode', $postcode);
			$req->bindParam(':city', $city);
			$req->bindParam(':country', $country);
			$req->bindParam(':latitude', $latitude);
			$req->bindParam(':longitude', $longitude);

			$result = $req->execute();
		}

		return $result;
	}

	public function updateLocation(){
		$locationid     = $this->checkZone($_POST["locationid"]);
		$postcode    	= $this->checkZone($_POST["postcode"]);
		$city     		= $this->checkZone($_POST["city"]);
		$country    	= $this->checkZone($_POST["country"]);
		// $locationid     = $this->checkZone($_POST["latitude"]);
		// $locationid     = $this->checkZone($_POST["longitude"]);

		$result 	= false;

		if ($this->connexion) {
			$req = $this->connexion->prepare("UPDATE student_location SET postcode=:postcode, city=:city, country=:country, latitude=:latitude, longitude=:longitude WHERE locationid=:locationid");

			$req->bindParam(':locationid', $locationid);
			$req->bindParam(':postcode', $postcode);
			$req->bindParam(':city', $city);
			$req->bindParam(':country', $country);
			$req->bindParam(':latitude', $latitude);
			$req->bindParam(':longitude', $longitude);

			$result = $req->execute();
		}
		return $result;
	}

	public function deleteLocation(){
		$locationid = isset($_GET['id'])?$_GET['id']:0;
		$resultat 	= false;
		if ($this->connexion){
			$req = $this->connexion->prepare("DELETE FROM student_location WHERE locationid=:locationid");
			$req->bindParam(':locationid', $locationid);
		
			$resultat = $req->execute();
		}
		return $resultat;
	}
	
}