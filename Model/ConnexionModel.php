<?php

require 'Model/BaseModel.php';

class ConnexionModel extends BaseModel
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
     * Fonction de connexion à la session
     * On vérifie si le login et le mot de passe correspond
     * sinon retourne null
     * @return [bool] [description]
     */
    public function login()
    {
        $table = array();
        $login = $this->checkZone($_POST['login']);
        $password = $this->checkZone($_POST['pw']);

        if ($this->connexion) {
            $req = $this->connexion->prepare("SELECT userid, password FROM user WHERE username=:username");
            $req->bindParam(':username', $login);
            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        }

        if ($resultat) {
            if (password_verify($password, $resultat['password'])) {
                $user_id = $resultat['userid'];
                $username = hash('sha256', $login);

                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                return true;
                // echo "reussi";
            } else {
                return false;
                // echo 'erreur mot de passe incorrect';
            }
        } else {
            return false;
            // echo "erreur le login n'existe pas";
        }
    }

    /**
     * Fonction de deconnexion
     * On supprime les variables de session et on redirect vers l'index
     * @return [void] [description]
     */
    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location:index.php');
        exit;
    }
}
