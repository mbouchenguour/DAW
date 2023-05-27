<?php
require_once 'Controller.php';
require_once 'models/Utilisateur.php';
require_once 'models/Cours.php';

class QCMpCoController extends Controller
{
    public function index()
    {
        $this->checkIfLoggedIn();

        $this->genererQCM();
        $xml = new DOMDocument();
        $xml->load('qcm/pConnexion.xml');

        $xsl = new DOMDocument();
        $xsl->load('views/pConnexion.xsl');

        $processor = new XSLTProcessor();
        $processor->importStylesheet($xsl);

        $html = $processor->transformToXML($xml);

        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $user = $_SESSION['utilisateur'];
            $u = new Utilisateur();
            $resultatsQCM = $_POST; // Les réponses du QCM sont maintenant dans $_POST
            foreach ($resultatsQCM as $key => $value){
                if($value == 1)
                    $u->saveRecommandation($user['id'], $key);
            }
            $u->updatePCO($user['id']);
            header('Location: index.php?controller=QCMpCo&action=succes');
            exit();
        }
        echo $html;
    }

    public function succes()
    {
        $this->checkIfLoggedIn();
        require 'views/succes.php';
    }

    private function genererQCM(){
        $this->checkIfLoggedIn();
        $coursModel = new Cours();
        $lcours = $coursModel->getCours();

        $dom = new DOMDocument('1.0', 'UTF-8');

        // Création de l'élément racine quiz
        $quiz = $dom->createElement('quiz');
        $dom->appendChild($quiz);

        // Parcours des cours et création des éléments XML correspondants
        foreach ($lcours as $cours) {
            $question = $dom->createElement('question');
            $question->setAttribute('id', $cours['id']);
            $titre = $dom->createElement('titre', "Connais-tu le langage " . $cours['titre']);
            $choix = $dom->createElement('choix');
            $choix->appendChild($dom->createElement('oui', 'Oui'));
            $choix->appendChild($dom->createElement('non', 'Non'));
            $question->appendChild($titre);
            $question->appendChild($choix);
            $quiz->appendChild($question);
        }

        // Affichage du document XML
        $dom->formatOutput = true;
        $dom->save('qcm/pConnexion.xml');
    }
}
