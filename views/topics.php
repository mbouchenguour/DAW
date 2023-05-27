<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics - Gestion de formations</title>
    <link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
</head>
<body>
    <?php require 'navbar.php'; ?>	
    <main>
        <section class="features">
            <div id="containerPrincipal" class="container">
                <h1>Liste des topics</h1>
                <div class="cours-grid">
                    <?php foreach ($topics as $topic): ?>
                        <div class="cours-card" onclick="location.href='index.php?controller=Forum&action=sujets&topic_id=<?php echo $topic['id']; ?>'">
                            <div class="cours-header" style="background-color: #FF9800;"></div>
                            <p><?php echo $topic['titre']; ?></p>
                        </div>		
                    <?php endforeach; ?>    
                <div>
            </div>
        </section>
    </main>
    <script src="assets/js/modeNuit.js"></script>
</body>
</html>
