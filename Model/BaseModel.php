<?php

abstract class BaseModel
{
    protected $connexion;

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
        $this->connexion = false;

        try {
            $this->connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);
            $this->connexion->exec('SET NAMES utf8');
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }


    /**
     * Vérification, si l'utilisateur est connecté
     * @return [bool] [description]
     */
    public function login_check()
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'])) {

            // On récupère les variables de sessions
            $user_id = $_SESSION['user_id'];
            $login_hash = $_SESSION['username'];

            // On compare le login de session hasher avec le login en base de donnée grâce au user_id
            $req = $this->connexion->prepare("SELECT username FROM user WHERE userid=:user_id");
            $req->bindParam(':user_id', $user_id);
            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);

            $username = hash('sha256', $resultat['username']);

            if ($login_hash === $username) {
                // L'utilisateur est connecté
                return true;
            } else {
                // L'utilisateur n'est pas connecté
                return false;
            }

        } else {
            // La session n'est pas initialisé
            return false;
        }
    }
}
