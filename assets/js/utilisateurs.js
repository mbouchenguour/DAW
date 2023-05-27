var addUtilisateurModal = document.getElementById("add-user-modal");
var addUtilisateurTrigger = document.getElementById("add-user-trigger");
var addUtilisateurClose = document.getElementsByClassName("close")[0];
console.log(addUtilisateurClose);
addUtilisateurTrigger.onclick = function () {
    addUtilisateurModal.style.display = "block";
};

addUtilisateurClose.onclick = function () {
    addUtilisateurModal.style.display = "none";
};

var modifierUtilisateurModal = document.getElementById("modifier-utilisateur-modal");
var modifierUtilisateurClose = document.getElementsByClassName("close")[1];

modifierUtilisateurClose.onclick = function () {
    modifierUtilisateurModal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == addUtilisateurModal) {
        addUtilisateurModal.style.display = "none";
    }
    if (event.target == modifierUtilisateurModal) {
        modifierUtilisateurModal.style.display = "none";
    }
};

function deleteUtilisateur(e, id, idCo) {
    var confirmation = confirm("Voulez-vous vraiment supprimer ce utilisateur ?");
    if (confirmation) {
        window.location.href = "index.php?controller=Admin&action=supprimerUtilisateur&id_utilisateur=" + id + "&id_cours=" + idCo;
    }
}

function openModifierUtilisateurForm(e, id, nomUtilisateur, email, role) {
    var modifierUtilisateurModal = document.getElementById("modifier-utilisateur-modal");
    modifierUtilisateurModal.style.display = "block";
    document.getElementById("modifier-nom_utilisateur").value = nomUtilisateur;
    document.getElementById("modifier-email").value = email;
    document.getElementById("modifier-role").value = role;
    document.getElementById("modifier-utilisateur-form").setAttribute("action", "index.php?controller=Admin&action=modifierUtilisateur&id_utilisateur=" + id);
}


    

