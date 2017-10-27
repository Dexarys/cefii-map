<?php

abstract class BaseModel
{
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

        define('SERVER', "localhost");
        define('USER', "root");
        define('PASSWORD', "");
        define('BASE', "projet_007");

        $this->connexion = false;

        try {
            $this->connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);
            $this->connexion->exec('SET NAMES utf8');

        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}
