<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $chapitre['titre']; ?></title>
    <link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
</head>
<body>
    <?php require 'navbar.php'; ?>
    <main>
    <section class="features">
        <h1><?php echo $chapitre['titre']; ?></h1>
        <audio controls>
            <source src="<?php echo $chapitre['url_fichier']; ?>" type="audio/mpeg">
            Votre navigateur ne prend pas en charge les fichiers audio HTML5.
        </audio>
    </section>
    </main>
    <script src="assets/js/modeNuit.js"></script>
</body>
</html>
