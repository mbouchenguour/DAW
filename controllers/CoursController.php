<?php
require_once 'Controller.php';
require_once 'models/Chapitres.php';
require_once 'models/Cours.php';
require_once 'models/QCM.php';

class CoursController extends Controller
{
    public function index()
    {
        $this->checkIfLoggedIn();
        if(isset($_GET['id_cours'])){
            $id_cours = intval($_GET['id_cours']); // Assure que id_cours est un entier
            $coursModel = new Cours();
            $chapitresModel = new Chapitres();
            $qcmModel = new QCM();

            $cours = $coursModel->getCoursById($id_cours);
            $chapitres = $chapitresModel->getChapitresByCourse($id_cours);
            $qcml = $qcmModel->getQCMByIdCours($id_cours);

            // Incluez la vue pour afficher les chapitres d'un cours
            require_once 'views/chapitres.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }
}
