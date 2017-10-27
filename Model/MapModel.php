<?php

require 'Model/BaseModel.php';

class MapModel extends BaseModel
{
    public function getMarkers()
    {
        $table = array();

        if ($this->connexion) {
            $resultat = $this->connexion->query("SELECT latitude, longitude FROM student_location");
            if ($resultat) {
                $table = $resultat->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        return $table;
    }
}
