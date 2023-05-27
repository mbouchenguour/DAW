<?php
require_once 'Controller.php';
require_once 'config/Bdd.php';
require_once 'models/Cours.php';
require_once 'models/Utilisateur.php';

class UtilisateursController extends Controller
{

    public function index()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }

        $utilisateurModel = new Utilisateur();
        $utilisateurs = $utilisateurModel->getUtilisateurs();

        require_once 'views/utilisateurs.php';

    }
}
