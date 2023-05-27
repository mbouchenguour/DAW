<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sujets - Gestion de formations</title>
    <link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
    <style>#rbtn {
	width: 100%;
    background-color: rgb(255, 123, 0); /* Modification de la couleur de fond */
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}

#rbtn:hover {
    background-color: #fff;
    color: rgb(255, 123, 0);
}</style>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <main>
    <section class="features">	
        <div id="containerPrincipal" class="container">
            <h1>Liste des sujets</h1>
            <button id="add-sujet-trigger">Ajouter un sujet</button>  
            <div class="sujet-grid">
                <?php foreach ($sujets as $sujet): ?>
                    <div class="sujet-card" onclick="location.href='index.php?controller=Forum&action=messages&sujet_id=<?php echo $sujet['id']; ?>'">
                        <div class="sujet-header" style="background-color: #FF9800;"></div>
                        <p><?php echo $sujet['titre']; ?></p>
                        <p><?php echo $u->getById($sujet['utilisateur_id'])[0]['nom_utilisateur']; ?></p>
                        <p><?php echo $sujet['horodatage']; ?></p>
                    </div>		
                <?php endforeach; ?>    
            <div>
        </div>
        
        <a class="return-button" href="index.php?controller=Forum&action=index">Retour aux topics</a>

        <div id="add-sujet-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                    <h2>Ajouter un sujet</h2>
                    <form action="index.php?controller=Forum&action=addSujet&topic_id=<?php echo $topic_id; ?>" method="post">
                        <label for="titre">Titre du sujet :</label>
                        <input type="text" name="titre" id="titre" required>
                        <label for="message">Message initial :</label>
                        <textarea name="message" id="message" required></textarea>
                        <button id ="rbtn" type="submit">Créer un sujet</button>
                    </form>
            </div>
        </div>
    </section>
    </main>
    <script src="assets/js/sujets.js"></script>	
    <script src="assets/js/modeNuit.js"></script>
</body>
</html>
