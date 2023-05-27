<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Accueil - Gestion de cours</title>
		<link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
	</head>
	<body>
		<?php require 'navbar.php'; ?>
		<main>
			<section class="hero">
				<h1>Bienvenue sur le site de formation</h1>
				<p>Obtenez les compétences dont vous avez besoin pour réussir.</p>
				<a href="#containerPrincipal" class="btn">Commencez maintenant</a>
			</section>
			<section class="features">
				<div id="containerPrincipal" class="container">
					<h2>Nos formation</h2>
                    <?php if (!empty($coursU)): ?>
                        <h2>Recommandations</h2>		
						<div class="cours-grid">
							<?php foreach ($coursU as $cour): ?>
							<div class="cours-card" onclick="location.href='index.php?controller=Cours&id_cours=<?php echo $cour['id']; ?>'">
								<div class="cours-header" style="background-color: #FF9800;"></div>
								<h3><?php echo htmlspecialchars($cour['titre']); ?></h3>
								<p><?php echo htmlspecialchars($cour['description']); ?></p>
							</div>
							<?php endforeach; ?>
						</div>
                    <?php endif; ?>
					<h2>Tous les cours</h2>		
					<div class="cours-grid">
						<?php if($_SESSION['utilisateur']['role'] == 'admin'):  ?>
							<div class="cours-card" id="add-cours-trigger">
									<div class="cours-header" style="background-color: #FF5722;"></div>
									<h3>Ajouter un cours</h3>
							</div>
						<?php endif; ?>
						<?php foreach ($cours as $cour): ?>
						<div class="cours-card" onclick="location.href='index.php?controller=Cours&id_cours=<?php echo $cour['id']; ?>'">
							<div class="cours-header" style="background-color: #FF5722;"></div>
							<h3><?php echo htmlspecialchars($cour['titre']); ?></h3>
							<p><?php echo htmlspecialchars($cour['description']); ?></p>
							<?php if($_SESSION['utilisateur']['role'] == 'admin'): ?>
								<div class="card-actions">
									<img src="assets/images/stylo.png" alt="Modifier" class="edit-icon" onclick="openModifierCoursForm(event, <?php echo $cour['id']; ?>, '<?php echo htmlspecialchars(addslashes($cour['titre']), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($cour['description']), ENT_QUOTES, 'UTF-8'); ?>');">
									<img src="assets/images/croix.jpg" alt="Supprimer" class="delete-icon" onclick="deleteCours(event, <?php echo $cour['id']; ?>);">
								</div>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>
						
					</div>
				</div>
			</section>

		

		<!-- Formulaire d'ajout de cours -->
			<div id="add-cours-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Ajouter un cours</h2>
					<form method="post" action="index.php?controller=Admin&action=addCours">
						<label for="titre">Titre:</label>
						<input type="text" id="titre" name="titre" required>

						<label for="description">Description:</label>
						<textarea id="description" name="description" required></textarea>

						<input type="submit" value="Ajouter le cours">
					</form>
				</div>
			</div>

			<!-- Formulaire de modification de cours -->
			<div id="modifier-cours-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Modifier un cours</h2>
					<form method="post" id="modifier-cours-form">
						<label for="modifier-titre">Titre:</label>
						<input type="text" id="modifier-titre" name="titre" required>

						<label for="modifier-description">Description:</label>
						<textarea id="modifier-description" name="description" required></textarea>

						<input type="submit" value="Modifier le cours">
					</form>
				</div>
			</div>
		</main>								

		<footer>
			<p>Tous droits réservés.</p>
		</footer>

	<script src="assets/js/accueil.js"></script>	
	<script src="assets/js/modeNuit.js"></script>								
	</body>
</html>


