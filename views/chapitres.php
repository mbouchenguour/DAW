<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chapitres - Gestion de formations</title>
        <link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
    </head>
    
    <body>
    <?php require 'navbar.php'; ?>
		<main>
            <h1><?php echo htmlspecialchars($cours[0]['titre']); ?></h1>
            <h3><?php echo htmlspecialchars($cours[0]['description']); ?></h3>
            <section class="features">
                <?php if (!empty($chapitres)): ?>
                    <h2>Chapitres :</h2>
                        <div class="chapitre-grid">
                        <?php if ($_SESSION['utilisateur']['role'] == 'admin'): ?>
                                <div class="chapitre-card" id="add-chapitre-trigger">
                                        <div class="chapitre-header" style="background-color: #FF5722;"></div>
                                        <h3>Ajouter un chapitre</h3>
                                </div>
                        <?php endif; ?>
                            <?php foreach ($chapitres as $chapitre) : ?>
                                <div class="chapitre-card" onclick="location.href='index.php?controller=Chapitre&id_chapitre=<?php echo $chapitre['id']; ?>'">
                                    <div class="chapitre-header" style="background-color: #FF5722;"></div>
                                    <h3><?php echo htmlspecialchars($chapitre['titre']); ?></h3>
                                    <p>Type de fichier : <?php echo htmlspecialchars($chapitre['type_fichier']); ?></p>
                                    <?php if($_SESSION['utilisateur']['role'] == 'admin'): ?>
                                        <div class="card-actions">
                                            <img src="assets/images/stylo.png" alt="Modifier" class="edit-icon" onclick="openModifierChapitreForm(event, <?php echo $chapitre['id']; ?>, '<?php echo htmlspecialchars(addslashes($chapitre['titre']), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($chapitre['url_fichier']), ENT_QUOTES, 'UTF-8'); ?>');">
                                            <img src="assets/images/croix.jpg" alt="Supprimer" class="delete-icon" onclick="deleteChapitre(event, <?php echo $chapitre['id']; ?>, <?php echo $cours[0]['id']; ?>);">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                <?php elseif ($_SESSION['utilisateur']['role'] == 'admin'): ?>
                    <h2>Chapitres :</h2>
                    <div class="chapitre-grid">
                            <div class="chapitre-card" id="add-chapitre-trigger">
                                    <div class="chapitre-header" style="background-color: #FF5722;"></div>
                                    <h3>Ajouter un chapitre</h3>
                            </div>
                    </div>
                <?php else: ?>
                    <p>Aucun chapitre pour le moment </p>
                <?php endif; ?>




                <?php if (!empty($qcml)): ?>
                    <h2>QCM :</h2>
                        <div class="chapitre-grid">
                        <?php if ($_SESSION['utilisateur']['role'] == 'admin'): ?>
                                <div class="chapitre-card" id="add-QCM-trigger">
                                        <div class="chapitre-header" style="background-color: #FF9800;"></div>
                                        <h3>Ajouter un QCM</h3>
                                </div>
                        <?php endif; ?>
                            <?php foreach ($qcml as $qcm) : ?>
                                <div class="chapitre-card" onclick="location.href='index.php?controller=QCM&id=<?php echo $qcm['id']; ?>'">
                                    <div class="chapitre-header" style="background-color: #FF9800;"></div>
                                    <h3><?php echo htmlspecialchars($qcm['titre']); ?></h3>
                                    <?php if($_SESSION['utilisateur']['role'] == 'admin'): ?>
                                        <div class="card-actions">
                                            <img src="assets/images/stylo.png" alt="Modifier" class="edit-icon" onclick="openModifierQCMForm(event, <?php echo $qcm['id']; ?>, '<?php echo htmlspecialchars(addslashes($qcm['titre']), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($qcm['url']), ENT_QUOTES, 'UTF-8'); ?>');">
                                            <img src="assets/images/croix.jpg" alt="Supprimer" class="delete-icon" onclick="deleteQCM(event, <?php echo $qcm['id']; ?>, <?php echo $qcm['id_cours']; ?>)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($_SESSION['utilisateur']['role'] == 'admin'): ?>
                        <h2>QCM :</h2>
                        <div class="chapitre-grid">
                                <div class="chapitre-card" id="add-QCM-trigger">
                                        <div class="chapitre-header" style="background-color: #FF9800;"></div>
                                        <h3>Ajouter un QCM</h3>
                                </div>
                        </div>
                    <?php else: ?>
                        <p>Aucun QCM pour le moment </p>
                    <?php endif; ?>
            </section>


            <div id="add-QCM-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Ajouter un QCM</h2>
					<form method="post" enctype="multipart/form-data" action="index.php?controller=Admin&action=addQCM&id= <?php echo $cours[0]['id'] ?>">
						<label for="titre">Titre:</label>
						<input type="text" id="titre" name="titre" required>

						<label for="fichier">Fichier:</label>
                        <input type="file" id="fichier" name="fichier" accept=".xml" required>

						<input type="submit" value="Ajouter le QCM">
					</form>
				</div>
			</div>

			<!-- Formulaire de modification de QCM -->
			<div id="modifier-QCM-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Modifier un QCM</h2>
					<form method="post" enctype="multipart/form-data" id="modifier-QCM-form">
						<label for="modifier-titre">Titre:</label>
						<input type="text" id="modifier-titreQCM" name="titre" required>

                        <label for="url">Ancien URL :</label>
                        <input type="text" id="urlQCM" name="url" readonly>

						<label for="modifier-fichier">Fichier:</label>
                        <input type="file" id="modifier-fichierQCM" name="fichier" accept=".xml">

						<input type="submit" value="Modifier le QCM">
					</form>
				</div>
			</div>


            <div id="add-chapitre-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Ajouter un chapitre</h2>
					<form method="post" enctype="multipart/form-data" action="index.php?controller=Admin&action=addChapitre&id= <?php echo $cours[0]['id'] ?>">
						<label for="titre">Titre:</label>
						<input type="text" id="titre" name="titre" required>

						<label for="fichier">Fichier:</label>
                        <input type="file" id="fichier" name="fichier" accept=".pdf,.mp4,.mp3,.pptx" required>

						<input type="submit" value="Ajouter le chapitre">
					</form>
				</div>
			</div>

			<!-- Formulaire de modification de chapitre -->
			<div id="modifier-chapitre-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Modifier un chapitre</h2>
					<form method="post" enctype="multipart/form-data" id="modifier-chapitre-form">
						<label for="modifier-titre">Titre:</label>
						<input type="text" id="modifier-titre" name="titre" required>

                        <label for="url">Ancien URL :</label>
                        <input type="text" id="url" name="url" readonly>

						<label for="modifier-fichier">Fichier:</label>
                        <input type="file" id="modifier-fichier" name="fichier" accept=".pdf,.mp4,.mp3,.pptx">

						<input type="submit" value="Modifier le chapitre">
					</form>
				</div>
			</div>
        </main>
        <script src="assets/js/chapitres.js"></script>
        <script src="assets/js/modeNuit.js"></script>
    </body>
</html>

