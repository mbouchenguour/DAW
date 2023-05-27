<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Échec QCM</title>
		<link id="theme-style" rel="stylesheet" href="assets/css/indexNuit.css">
	</head>
	<body>
		<?php require 'navbar.php'; ?>
		<main>
			<section class="features">
				<h1>Dommage !</h1>
				<p>Vous n'avez pas réussi le QCM. Vous avez eu un résultat de <?php echo $_GET['nbJ'] ?> sur <?php echo $_GET['nbQ'] ?>.</p>
                <p style="margin-bottom: 50px">Vous pourrez retenter votre chance plus tard.</p>
				<a href="index.php" class="btn">Retour à l'accueil</a>
			</section>
		</main>								

		<footer>
			<p>Tous droits réservés.</p>
		</footer>

	<script src="assets/js/accueil.js"></script>	
	<script src="assets/js/modeNuit.js"></script>								
	</body>
</html>
