<?php
require 'Model/BaseModel.php';

class AdminModel extends BaseModel {
	/**
	 * Verification de la zone
	 * Retourne de la valeur de la zone
	 * sinon retourne null
	 * @return [string] [description]
	 */
	private function checkZone($zone){
		return isset($zone)?$zone:null;
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

		$address = $postcode." ".$city." ".$country;

		$parsed_json = json_decode($this->findCoordinates($address));

		$latitude	= $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$longitude	= $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

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

		$address = $postcode." ".$city." ".$country;

		$parsed_json = json_decode($this->findCoordinates($address));

		$latitude	= $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$longitude	= $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

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

	private function findCoordinates($address){
		// On prépare l'URL du géocodeur
		$geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";
		 
		// Conversion en UTF-8
		$url_address = utf8_encode($address);
		 
		// On encode l'adresse
		$url_address = urlencode($url_address);
		 
		// On prépare notre requête
		$query = sprintf($geocoder,$url_address);
		 
		// On interroge le serveur
		$results = file_get_contents($query);

		return $results;
	}
	
}