<?php

abstract class BaseModel
{
    // private $connexion;

    /**
     * Constructeur du modèle
     * @return [object] [description]
     */
    public function __construct()
    {
        $this->connectDb();
    }

    /**
     * Connexion à la Bdd
     * @return [object] [description]
     */
    private function connectDb()
    {
        // define('SERVER',"sqlprive-pc2372-001.privatesql.ha.ovh.net");
        // define('USER',"cefiidev593");
        // define('PASSWORD',"oT93qA9v");
        // define('BASE',"cefiidev593");

        define('SERVER', "localhost");
        define('USER', "root");
        define('PASSWORD', "4923dex");
        define('BASE', "projet_cefii");

        $this->connexion = false;

        try {
            $this->connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);
            $this->connexion->exec('SET NAMES utf8');
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}
