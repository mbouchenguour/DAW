<?php
require_once 'Controller.php';
require_once 'models/Chapitres.php';
require_once 'models/Cours.php';

class ChapitreController extends Controller
{
    public function index()
    {
        $this->checkIfLoggedIn();

        if (isset($_GET['id_chapitre'])) {
            $id_chapitre = intval($_GET['id_chapitre']);
            $chapitresModel = new Chapitres();
            $chapitre = $chapitresModel->getChapitreById($id_chapitre);

            
            if ($chapitre) {
                $type_fichier = $chapitre['type_fichier'];
                require_once "views/chapitre_{$type_fichier}.php";
            } else {
                echo '<p>Chapitres/cours inconnus</p>';
            }
        } else {
            echo '<p>Chapitres/cours inconnus</p>';
        }
    }

    
}
