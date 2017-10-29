<?php
require 'Model/BaseModel.php';

class AdminModel extends BaseModel
{

	/**
	 * Verification de la zone
	 * Retourne de la valeur de la zone
	 * sinon retourne null
	 * @return [string] [description]
	 */
	private function checkZone($zone)
    {
		return isset($zone)?$zone:null;
	}


    /**
	 * Récupération des données de locations
	 * @return [string] [description]
	 */
	public function getAllLocations() {
		$table = array(); // variable vide en cas d'erreur
		if ($this->connexion) {
			$requete = "SELECT * FROM student_location";
			$resultat = $this->connexion->query($requete);

			if ($resultat) {
				$table = $resultat->fetchAll(PDO::FETCH_ASSOC);
			}
		}

		return $table;
	}


    /**
	 * Insertion des données remplis dans le formulaire
     * On calcul également la latitude et la longitude
	 * @return [string] [description]
	 */
	public function insertLocation() {
		$postcode = $this->checkZone($_POST["postcode"]);
		$city = $this->checkZone($_POST["city"]);
		$country = $this->checkZone($_POST["country"]);

		$address = $postcode." ".$city." ".$country;

		$parsed_json = json_decode($this->findCoordinates($address));

				var_dump($parsed_json);


		$latitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$longitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

		$result = false;

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

    /**
	 * Modification des données de locations
	 * @return [string] [description]
	 */
	public function updateLocation(){
		$locationid = $this->checkZone($_POST["locationid"]);
		$postcode = $this->checkZone($_POST["postcode"]);
		$city = $this->checkZone($_POST["city"]);
		$country = $this->checkZone($_POST["country"]);

		$address = $postcode." ".$city." ".$country;

		$parsed_json = json_decode($this->findCoordinates($address));

		$latitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$longitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

		$result = false;

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

    /**
	 * Suppression des données de locations
	 * @return [string] [description]
	 */
	public function deleteLocation(){
		$locationid = isset($_GET['id'])?$_GET['id']:0;
		$resultat = false;
		if ($this->connexion){
			$req = $this->connexion->prepare("DELETE FROM student_location WHERE locationid=:locationid");
			$req->bindParam(':locationid', $locationid);

			$resultat = $req->execute();
		}
		return $resultat;
	}

    /**
	 * Récupération des données de locations latitude/longitude
	 * @return [string] [description]
	 */
	private function findCoordinates($address){
		// On prépare l'URL du géocodeur
		$geocoder = "https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=AIzaSyA9-WuX91A9deldsoOBLcdZ4m9yXWM65Rg";

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
