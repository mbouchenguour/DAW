<?php
require_once 'Controller.php';
require_once 'models/Utilisateur.php';
require_once 'models/Cours.php';

class QcmController extends Controller
{
    public function index()
    {
        $this->checkIfLoggedIn();
        if (isset($_GET['id'])) {
            $qcmModel = new QCM();
            $qcm = $qcmModel->getQCMById($_GET['id']);

            $xml = new DOMDocument();
            $xml->load($qcm['url']);

            $xsl = new DOMDocument();
            $xsl->load('qcm/qcm.xsl');

            $processor = new XSLTProcessor();
            $processor->importStylesheet($xsl);
            $processor->setParameter('', 'userRole', $_SESSION['utilisateur']['role']);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $quiz = simplexml_load_file($qcm['url']);
                $correctAnswers = 0;
                $submittedAnswers = [];
                foreach ($_POST as $key => $value) {
                    if (preg_match('/question(\d+)/', $key, $matches)) {
                        $questionId = $matches[1];
                        $submittedAnswers[$questionId] = $value;
                    }
                }                

                foreach ($quiz->question as $question) {
                    $questionId = (string)$question['id'];
                    $correctOption = strtolower((string)$question->choix['correct']);
            
                    if (isset($submittedAnswers[$questionId]) && strtolower($submittedAnswers[$questionId]) === $correctOption) {
                        $correctAnswers++;
                    }
                }

                if($correctAnswers >= count($quiz->question)/2){
                    header('Location: index.php?controller=QCM&action=succes&nbQ=' . count($quiz->question) .'&nbJ=' . $correctAnswers);
                    exit();
                }
                else
                {
                    header('Location: index.php?controller=QCM&action=echec&nbQ=' . count($quiz->question) .'&nbJ=' . $correctAnswers);
                    exit();
                }
            }
            $html = $processor->transformToXML($xml);

            require 'views/qcm.php';
        } else {
            header('HTTP/1.0 404 Not Found');
            exit('Page non trouvée');
        }
    }

    public function succes()
    {
        require 'views/qcm_succes.php';
    }

    public function echec(){
        require 'views/qcm_echec.php';
    }




}
