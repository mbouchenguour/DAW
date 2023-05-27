<?php
require_once 'Controller.php';
require_once 'models/Topics.php';
require_once 'models/Sujets.php';
require_once 'models/Utilisateur.php';

class ForumController extends Controller
{
    public function index()
    {
        $this->checkIfLoggedIn();
        $topicModel = new Topics();
        $topics = $topicModel->getAllTopics();

        // Chargez la vue pour afficher la liste des topics
        require_once 'views/topics.php';
    }

    public function sujets()
    {

        $this->checkIfLoggedIn();
        if (isset($_GET['topic_id'])) {
            $topic_id = intval($_GET['topic_id']);
            $sujetForumModel = new Sujets();
            $sujets = $sujetForumModel->getSujetsByTopic($topic_id);
            $u = new Utilisateur();
            // Chargez la vue pour afficher la liste des sujets pour un topic spécifique
            require_once 'views/sujets.php';
        } else {
            header('Location: index.php?controller=Forum');
            exit();
        }
    }

    public function messages()
    {
        $this->checkIfLoggedIn();
        if (isset($_GET['sujet_id'])) {
            $sujet_id = intval($_GET['sujet_id']);
            $messagesModel = new Messages();

            $messages = $messagesModel->getMessagesBySujet($sujet_id);

            // Inclure la vue pour afficher les messages d'un sujet
            require_once 'views/messages.php';
        } else {
            header('Location: index.php?controller=Forum');
            exit();
        }
    }

    public function addMessage()
    {
        $this->checkIfLoggedIn();
        if (isset($_POST['message']) && isset($_GET['sujet_id'])) {
            $sujet_id = intval($_GET['sujet_id']);
            $message = $_POST['message'];

            // Vous pouvez remplacer 1 par l'ID de l'utilisateur actuellement connecté.
            $utilisateur_id = 1;

            $messagesModel = new Messages();
            $messagesModel->addMessage($utilisateur_id, $sujet_id, $message);

            // Rediriger vers la page des messages du sujet.
            header('Location: index.php?controller=Forum&action=messages&sujet_id=' . $sujet_id);
            exit();
        } else {
            header('Location: index.php?controller=Forum');
            exit();
        }
    }

    public function addSujet()
    {
        $this->checkIfLoggedIn();
        if (isset($_POST['titre']) && isset($_POST['message']) && isset($_GET['topic_id'])) {
            $topic_id = intval($_GET['topic_id']);
            $titre = $_POST['titre'];
            $message = $_POST['message'];

            // Vous pouvez remplacer 1 par l'ID de l'utilisateur actuellement connecté.
            $utilisateur_id = 1;

            $sujetForumModel = new Sujets();
            $sujet_id = $sujetForumModel->addSujet($utilisateur_id, $topic_id, $titre);

            $messagesModel = new Messages();
            $messagesModel->addMessage($utilisateur_id, $sujet_id, $message);

            // Rediriger vers la page des sujets du topic.
            header('Location: index.php?controller=Forum&action=sujets&topic_id=' . $topic_id);
            exit();
        } else {
            header('Location: index.php?controller=Forum&action=index');
            exit();
        }
    }



}
