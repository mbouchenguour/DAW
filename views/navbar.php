<header>
    <nav>
        <ul>
            <li><a id="modeNuit" href="#">Mode Nuit</a></li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?controller=Forum">Forum</a></li>
            <?php if($_SESSION['utilisateur']['role'] == 'admin'):  ?><li><a href="index.php?controller=Utilisateurs">Utilisateurs</a></li><?php endif; ?>
            <li><a href="index.php?controller=Authentification&action=logout">Déconnexion</a></li>
        </ul>
    </nav>
</header>