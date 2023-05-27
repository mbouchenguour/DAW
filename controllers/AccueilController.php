<?php
require_once 'Controller.php';
require_once 'config/Bdd.php';
require_once 'models/Cours.php';
require_once 'models/Utilisateur.php';

class AccueilController extends Controller
{

    public function index()
    {
        // Vérifie si l'utilisateur est connecté
        $this->checkIfLoggedIn();

        $coursModel = new Cours();
        $cours = $coursModel->getCours();
        $coursU = $coursModel->getCoursUser($_SESSION['utilisateur']['id']);

        require 'views/accueil.php';
    }
}
