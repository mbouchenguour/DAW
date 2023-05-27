<?php
require_once 'Controller.php';

class AuthentificationController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=Accueil');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            $utilisateur = new Utilisateur();
            $utilisateur->getByEmail($email);
            
            if ($utilisateur && password_verify($mdp, $utilisateur->getMotDePasse())) {
                $_SESSION['utilisateur'] = $utilisateur->toArray();
                if($utilisateur->getPremiereConnexion()){
                    header('Location: index.php?controller=QCMpCo');
                    exit();
                }
                else {
                    header('Location: index.php?controller=Accueil');
                    exit();
                }
                
            } else {
                $erreur = 'Email ou mot de passe incorrect.';
            }
        }

        require 'views/login.php';
    }

    public function logout()
    {
        $this->checkIfLoggedIn();
        session_destroy();
        header('Location: index.php?controller=Authentification');
        exit();
    }
}
