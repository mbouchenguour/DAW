<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Gestion de formations</title>
    <link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
</head>
<body>
    
    <?php require 'navbar.php'; ?>
    <main>
        
        <section class="features2">	
        <div id="containerPrincipal" class="container">
        <h1>Messages du sujet</h1>
        <ul>
        <?php foreach ($messages as $message): ?>
            <li>
                <div class="message-info">
                    <span class="message-author"><?php echo $message['nom_utilisateur']; ?></span>
                    <span class="message-timestamp"><?php echo $message['horodatage']; ?></span>
                </div>
                <div class="message-content"><?php echo $message['message']; ?></div>
            </li>
        <?php endforeach; ?>
        </ul>
        <form action="index.php?controller=Forum&action=addMessage&sujet_id=<?php echo $sujet_id; ?>" method="post">
            <label for="message">Nouveau message :</label>
            <textarea name="message" id="message" rows="5" cols="50" required></textarea>
            <button type="submit">Envoyer</button>
        </form>

        <a href="index.php?controller=Forum&action=sujets&topic_id=<?php echo $messages[0]['topic_id']; ?>">Retour aux sujets</a>
        </div>
    </section>
    </main>
<script src="assets/js/modeNuit.js"></script>
</body>
</html>
