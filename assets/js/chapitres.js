// Add chapitre Modal
var addChapitreModal = document.getElementById("add-chapitre-modal");
var addChapitreTrigger = document.getElementById("add-chapitre-trigger");
var addChapitreClose = document.getElementsByClassName("close")[2];

// Modifier chapitre Modal
var modifierChapitreModal = document.getElementById("modifier-chapitre-modal");
var modifierChapitreClose = document.getElementsByClassName("close")[3];

// Add QCM Modal
var addQCMModal = document.getElementById("add-QCM-modal");
var addQCMTrigger = document.getElementById("add-QCM-trigger");
var addQCMClose = document.getElementsByClassName("close")[0];

// Modifier QCM Modal
var modifierQCMModal = document.getElementById("modifier-QCM-modal");
var modifierQCMClose = document.getElementsByClassName("close")[1];



addChapitreTrigger.onclick = function () {
	addChapitreModal.style.display = "block";
};
addChapitreClose.onclick = function () {
	addChapitreModal.style.display = "none";
};

modifierChapitreClose.onclick = function () {
	modifierChapitreModal.style.display = "none";
};


addQCMTrigger.onclick = function () {
	addQCMModal.style.display = "block";
};

addQCMClose.onclick = function () {
	addQCMModal.style.display = "none";
};

modifierQCMClose.onclick = function () {
	modifierQCMModal.style.display = "none";
};




window.onclick = function (event) {
	if (event.target == addChapitreModal) {
		addChapitreModal.style.display = "none";
	}
	if (event.target == modifierChapitreModal) {
		modifierChapitreModal.style.display = "none";
	}
	if (event.target == addQCMModal) {
		addQCMModal.style.display = "none";
	}
	if (event.target == modifierQCMModal) {
		modifierQCMModal.style.display = "none";
	}
};

function deleteChapitre(e, id, idCo) {
	e.stopPropagation();
	var confirmation = confirm("Voulez-vous vraiment supprimer ce chapitre ?");
	if (confirmation) {
		window.location.href = "index.php?controller=Admin&action=supprimerChapitre&id_chapitre=" + id + "&id_cours="+idCo;
	}
}

function openModifierChapitreForm(e, id, titre, fichier) {
	e.stopPropagation();
	modifierChapitreModal.style.display = "block";
	document.getElementById("modifier-titre").value = titre;
	document.getElementById("url").value = fichier;
	document.getElementById("modifier-chapitre-form").setAttribute("action", "index.php?controller=Admin&action=modifierChapitre&id_chapitre=" + id);
}


function deleteQCM(e, id, idCo) {
	e.stopPropagation();
	var confirmation = confirm("Voulez-vous vraiment supprimer ce QCM ?");
	if (confirmation) {
		window.location.href = "index.php?controller=Admin&action=supprimerQCM&id_qcm=" + id + "&id_cours="+idCo;;
	}
}

function openModifierQCMForm(e, id, titre, url) {
	e.stopPropagation();
	modifierQCMModal.style.display = "block";
	document.getElementById("modifier-titreQCM").value = titre;
	document.getElementById("urlQCM").value = url;
	document.getElementById("modifier-QCM-form").setAttribute("action", "index.php?controller=Admin&action=modifierQCM&id=" + id);
}