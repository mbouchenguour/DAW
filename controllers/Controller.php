<?php
abstract class Controller
{
    protected function checkIfLoggedIn()
    {
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=Authentification');
            exit();
        }/*else if($_SESSION['utilisateur']['premiere_connexion'])
        {
            header('Location: index.php?controller=QCMpCo&action=afficherQCM');
            exit();
        }*/
    }
}
