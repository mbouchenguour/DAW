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
            <section class="features">
                <h1>Liste des utilisateurs</h1>
                <button id="add-user-trigger">Ajouter un utilisateur</button>            
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($utilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($utilisateur['id']); ?></td>
                            <td><?php echo htmlspecialchars($utilisateur['nom_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                            <td><?php echo htmlspecialchars($utilisateur['role']); ?></td>
                            <td style="width: 130px">
                                <img style="margin-right: 30px"src="assets/images/stylo.png" alt="Modifier" class="edit-icon" onclick="openModifierUtilisateurForm(event, <?php echo $utilisateur['id']; ?>, '<?php echo htmlspecialchars(addslashes($utilisateur['nom_utilisateur']), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($utilisateur['email']), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($utilisateur['role']), ENT_QUOTES, 'UTF-8'); ?>');">
                                <img src="assets/images/croix.jpg" alt="Supprimer" class="delete-icon" onclick="deleteUtilisateur(event, <?php echo $utilisateur['id']; ?>);">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
            <div id="add-user-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un utilisateur</h2>
                    <form method="post" action="index.php?controller=Admin&action=addUtilisateur">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>

                        <label for="username">Nom</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>

                        <label for="role">Rôle :</label>
                        <select id="role" name="role">
                            <option value="admin">Admin</option>
                            <option value="utilisateur">Utilisateur</option>
                        </select>

                        <input type="submit" value="Ajouter l'utilisateur">
                    </form>
                </div>
            </div>

            <div id="modifier-utilisateur-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Modifier un utilisateur</h2>
                    <form method="post" id="modifier-utilisateur-form">
                        <label for="modifier-nom_utilisateur">Nom d'utilisateur:</label>
                        <input type="text" id="modifier-nom_utilisateur" name="nom_utilisateur" required>

                        <label for="modifier-email">Email:</label>
                        <input type="email" id="modifier-email" name="email" required>

                        <label for="modifier-role">Rôle:</label>
                        <select id="modifier-role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="utilisateur">Utilisateur</option>
                        </select>

                        <input type="submit" value="Modifier l'utilisateur">
                    </form>
                </div>
            </div>   
            
            

        </main>
    <script src="assets/js/utilisateurs.js"></script>		
    <script src="assets/js/modeNuit.js"></script>			
	</body>
</html>


