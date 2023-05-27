<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de formations</title>
    <link rel="stylesheet" href="assets/css/login2.css">
</head>
<body>
    <div class="container">
	
	
        <h1>Connexion</h1>

        <?php if (isset($erreur)): ?>
            <p class="error"><?= $erreur ?></p>
        <?php endif; ?>
  <div class="logo-container">
                <a href="#"> 
                <img src="assets/images/ub.png" alt="Logo" href="#">
                </a>
              </div>
        <form action="index.php?controller=Authentification" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
