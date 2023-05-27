<?php
require_once 'Controller.php';
require_once 'models/Cours.php';
require_once 'models/Chapitres.php';
require_once 'models/QCM.php';

class AdminController extends Controller
{
    public function addCours()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }

        if (isset($_POST['titre']) && isset($_POST['description'])) {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $coursModel = new Cours();
            $coursModel->addCours($titre, $description);
        }

        header('Location: index.php');
        exit();

    }

    public function supprimerCours()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        
        if (isset($_GET['id_cours'])) {
            $id = intval($_GET['id_cours']);
            $coursModel = new Cours();
            $coursModel->supprimerCours($id);
        }

        header('Location: index.php');
        exit();
    }

    public function supprimerUtilisateur()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        
        if (isset($_GET['id_utilisateur'])) {
            $id = intval($_GET['id_utilisateur']);
            $u = new Utilisateur();
            $u->supprimerUtilisateur($id);
        }

        header('Location: index.php?controller=Utilisateurs');
        exit();
    }

    public function supprimerChapitre()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        
        if (isset($_GET['id_cours']) && isset($_GET['id_chapitre'])) {
            $id_chapitre = intval($_GET['id_chapitre']);
            $chapitresModel = new Chapitres();
            $url = $chapitresModel->getChapitreById($id_chapitre)['url_fichier'];
            if (file_exists($url)) {
                unlink($url);
            }
            
            $chapitresModel->supprimerChapitre($id_chapitre);

            header('Location: index.php?controller=Cours&id_cours=' . $_GET['id_cours']);
            exit();
        }
        header('Location: index.php');
        exit();
        
    }

    public function supprimerQCM()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        
        if (isset($_GET['id_cours']) && isset($_GET['id_qcm'])) {
            $id_qcm = intval($_GET['id_qcm']);
            $qcmModel = new QCM();
            $url = $qcmModel->getQCMById($id_qcm)['url'];
            if (file_exists($url)) {
                unlink($url);
            }
            $qcmModel->supprimerQCM($id_qcm);
            header('Location: index.php?controller=Cours&id_cours=' . $_GET['id_cours']);
            exit();
        }
        header('Location: index.php');
        exit();
        
    }

    public function modifierCours()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }

        if (isset($_GET['id_cours']) && isset($_POST['titre']) && isset($_POST['description'])) {
            $id = $_GET['id_cours'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $coursModel = new Cours();
            $coursModel->modifierCours($id, $titre, $description);
        }

        header('Location: index.php');
        exit();
    }

    public function modifierUtilisateur()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }

        if (isset($_GET['id_utilisateur']) && isset($_POST['nom_utilisateur']) && isset($_POST['email'])&& isset($_POST['role'])) {
            $id_utilisateur = $_GET['id_utilisateur'];
            $nom_utilisateur = $_POST['nom_utilisateur'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $u = new Utilisateur();
            $u->modifierUtilisateur($id_utilisateur, $nom_utilisateur, $email, $role);
        }
        
        header('Location: index.php?controller=Utilisateurs');
        exit();
        
    }

    public function addUtilisateur()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        print_r($_POST);
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            
            $nom = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $role = $_POST['role'];
            $u = new Utilisateur();
            $u->addUtilisateur($nom, $email, $pass, $role);
        }
        
        header('Location: index.php?controller=Utilisateurs');
        exit();
        
    }

    public function addChapitre(){
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['fichier']) && isset($_GET['id'])) {
                $nom_fichier = $_FILES['fichier']['name'];
                $type_fichier = $_FILES['fichier']['type'];
                $tmp_fichier = $_FILES['fichier']['tmp_name'];
                $erreur_fichier = $_FILES['fichier']['error'];
                $cours_id = $_GET['id'];
                print_r($_FILES['fichier']);
                if ($erreur_fichier == UPLOAD_ERR_OK) {
                    $titre = $_POST['titre'];
                    
        
                    $coursModel = new Cours();
                    $cours = $coursModel->getCoursById($cours_id);
                    $extension_fichier = pathinfo($nom_fichier, PATHINFO_EXTENSION);
                    if (!is_dir("fichiers/".$cours[0]['titre'])) {
                        mkdir("fichiers/".$cours[0]['titre']);
                    }
                    $path = "fichiers/".$cours[0]['titre']."/$titre.$extension_fichier";
                    $chapitresModel = new Chapitres();
                    $chapitresModel->addChapitre($cours_id, $titre, $extension_fichier, $path);
                    move_uploaded_file($tmp_fichier, $path);     
                    header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                    exit();
                } else {
                    switch ($erreur_fichier) {
                        case UPLOAD_ERR_INI_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $message = "Le fichier n'a été que partiellement téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $message = "Aucun fichier n'a été téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            $message = "Il manque un dossier temporaire.";
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            $message = "Échec de l'écriture du fichier sur le disque.";
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            $message = "Une extension PHP a arrêté l'envoi de fichier.";
                            break;
                        default:
                            $message = "Erreur inconnue lors de l'envoi du fichier.";
                            break;
                    }
                    echo "Une erreur est survenue lors du téléchargement du fichier : $message";
                }
            }
        }
    }

    public function addQCM(){
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['fichier']) && isset($_GET['id'])) {
                $nom_fichier = $_FILES['fichier']['name'];
                $type_fichier = $_FILES['fichier']['type'];
                $tmp_fichier = $_FILES['fichier']['tmp_name'];
                $erreur_fichier = $_FILES['fichier']['error'];
                $id = $_GET['id'];
                
                if ($erreur_fichier == UPLOAD_ERR_OK) {
                    $titre = $_POST['titre'];
                    
                    $coursModel = new Cours();
                    $cours = $coursModel->getCoursById($id);
                    if (!is_dir("qcm/".$cours[0]['titre'])) {
                        mkdir("qcm/".$cours[0]['titre']);
                    }

                    $path = "qcm/".$cours[0]['titre']."/$titre.xml";

                    $qcmModel = new QCM();
                    $qcmModel->addQCM($id, $titre, $path);

                    move_uploaded_file($tmp_fichier, $path);     
                    header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                    exit();
                } else {
                    switch ($erreur_fichier) {
                        case UPLOAD_ERR_INI_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $message = "Le fichier n'a été que partiellement téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $message = "Aucun fichier n'a été téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            $message = "Il manque un dossier temporaire.";
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            $message = "Échec de l'écriture du fichier sur le disque.";
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            $message = "Une extension PHP a arrêté l'envoi de fichier.";
                            break;
                        default:
                            $message = "Erreur inconnue lors de l'envoi du fichier.";
                            break;
                    }
                    echo "Une erreur est survenue lors du téléchargement du fichier : $message";
                }
            }
        }
    }

    public function modifierChapitre()
    {
        $this->checkIfLoggedIn();
        if($_SESSION['utilisateur']['role'] != 'admin'){
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['fichier']) && isset($_GET['id_chapitre'])) {
                $nom_fichier = $_FILES['fichier']['name'];
                $type_fichier = $_FILES['fichier']['type'];
                $tmp_fichier = $_FILES['fichier']['tmp_name'];
                $erreur_fichier = $_FILES['fichier']['error'];
                $chapitre_id = $_GET['id_chapitre'];
                
                $chapitresModel = new Chapitres();
                $chapitre = $chapitresModel->getChapitreById($chapitre_id);
                if ($erreur_fichier == UPLOAD_ERR_OK) {
                    $titre = $_POST['titre'];

                    $coursModel = new Cours();
                    $cours = $coursModel->getCoursById($chapitre['cours_id']);

                    if (!is_dir("fichiers/".$cours[0]['titre'])) {
                        mkdir("fichiers/".$cours[0]['titre']);
                    }

                    // Supprimer l'ancien fichier
                    if (file_exists($chapitre['url_fichier'])) {
                        unlink($chapitre['url_fichier']);
                    }

                    

                    $coursModel = new Cours();
                    $cours = $coursModel->getCoursById($chapitre['cours_id']);
                    $extension_fichier = pathinfo($nom_fichier, PATHINFO_EXTENSION);
                    $path = "fichiers/".$cours[0]['titre']."/$titre.$extension_fichier";
                    $chapitresModel->modifierChapitre($chapitre_id, $titre, $extension_fichier, $path);
                    move_uploaded_file($tmp_fichier, $path);     
                    header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                    exit();
                }
                elseif (isset($_GET['id_chapitre']) && isset($_POST['titre'])) {
                    $chapitresModel = new Chapitres();
                    $chapitre = $chapitresModel->getChapitreById($_GET['id_chapitre']);

                    $coursModel = new Cours();
                    $cours = $coursModel->getCoursById($chapitre['cours_id']);

                    $chapitresModel->modifierChapitre($_GET['id_chapitre'], $_POST['titre'], $chapitre['type_fichier'], $chapitre['url_fichier']);
                    header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                    exit();
                }
                else {
                    switch ($erreur_fichier) {
                        case UPLOAD_ERR_INI_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $message = "La taille du fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $message = "Le fichier n'a été que partiellement téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $message = "Aucun fichier n'a été téléchargé.";
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            $message = "Il manque un dossier temporaire.";
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            $message = "Échec de l'écriture du fichier sur le disque.";
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            $message = "Une extension PHP a arrêté l'envoi de fichier.";
                            break;
                        default:
                            $message = "Erreur inconnue lors de l'envoi du fichier.";
                            break;
                    }
                    echo "Une erreur est survenue lors du téléchargement du fichier : $message";
                }
            }
        }
    }

        public function modifierQCM()
        {
            $this->checkIfLoggedIn();
            if($_SESSION['utilisateur']['role'] != 'admin'){
                header('HTTP/1.0 404 Not Found');
                exit('Page non trouvée');
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_FILES['fichier']) && isset($_GET['id'])) {
                    $tmp_fichier = $_FILES['fichier']['tmp_name'];
                    $erreur_fichier = $_FILES['fichier']['error'];
                    $qcm_id = $_GET['id'];
                    
                    
                    if ($erreur_fichier == UPLOAD_ERR_OK) {
                        $qcmModel = new QCM();
                        $qcm = $qcmModel->getQCMById($qcm_id);
                        $titre = $_POST['titre'];

                        $coursModel = new Cours();
                        $cours = $coursModel->getCoursById($qcm['id_cours']);

                        if (!is_dir("fichiers/".$cours[0]['titre'])) {
                            mkdir("fichiers/".$cours[0]['titre']);
                        }

                        // Supprimer l'ancien fichier
                        if (file_exists($qcm['url'])) {
                            unlink($qcm['url']);
                        }
                        
                        $coursModel = new Cours();
                        $cours = $coursModel->getCoursById($qcm['id_cours']);
                        $path = "qcm/".$cours[0]['titre']."/$titre.xml";
                        $qcmModel->modifierQCM($qcm_id, $titre, $path);
                        echo $tmp_fichier;
                        move_uploaded_file($tmp_fichier, $path);     
                        header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                        exit();
                    }
                    elseif (isset($_GET['id']) && isset($_POST['titre'])) {
                        $qcmModel = new QCM();
                        $qcm = $qcmModel->getQCMById($qcm_id);

                        $coursModel = new Cours();
                        $cours = $coursModel->getCoursById($qcm['id_cours']);

                        $qcmModel->modifierQCM($_GET['id'], $_POST['titre'], $qcm['url']);
                        header('Location: index.php?controller=Cours&id_cours=' . $cours[0]['id']);
                        exit();
                    }
                    else {
                        switch ($erreur_fichier) {
                            case UPLOAD_ERR_INI_SIZE:
                                $message = "La taille du fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                                break;
                            case UPLOAD_ERR_FORM_SIZE:
                                $message = "La taille du fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                                break;
                            case UPLOAD_ERR_PARTIAL:
                                $message = "Le fichier n'a été que partiellement téléchargé.";
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                $message = "Aucun fichier n'a été téléchargé.";
                                break;
                            case UPLOAD_ERR_NO_TMP_DIR:
                                $message = "Il manque un dossier temporaire.";
                                break;
                            case UPLOAD_ERR_CANT_WRITE:
                                $message = "Échec de l'écriture du fichier sur le disque.";
                                break;
                            case UPLOAD_ERR_EXTENSION:
                                $message = "Une extension PHP a arrêté l'envoi de fichier.";
                                break;
                            default:
                                $message = "Erreur inconnue lors de l'envoi du fichier.";
                                break;
                        }
                        echo "Une erreur est survenue lors du téléchargement du fichier : $message";
                    }
                }
            }
        }


}
