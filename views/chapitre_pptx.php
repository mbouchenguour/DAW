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
    <section class="features" >
        <main>
            <h1><?php echo $chapitre['titre']; ?></h1>
            <p style="margin-top: 50px"><a href="<?php echo $chapitre['url_fichier']; ?>" download class="download-link">Télécharger le fichier PPTX</a></p>
            <p style="margin-top: 30px">Vous devez disposer de Microsoft PowerPoint ou d'un logiciel compatible pour ouvrir ce fichier.</p>
        </main>
    </section>
    <script src="assets/js/modeNuit.js"></script>
</body>
</html>
