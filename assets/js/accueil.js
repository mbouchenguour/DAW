// Add Cours Modal
var addCoursModal = document.getElementById("add-cours-modal");
var addCoursTrigger = document.getElementById("add-cours-trigger");
var addCoursClose = document.getElementsByClassName("close")[0];

addCoursTrigger.onclick = function () {
	addCoursModal.style.display = "block";
};

addCoursClose.onclick = function () {
	addCoursModal.style.display = "none";
};

// Modifier Cours Modal
var modifierCoursModal = document.getElementById("modifier-cours-modal");
var modifierCoursClose = document.getElementsByClassName("close")[1];

modifierCoursClose.onclick = function () {
	modifierCoursModal.style.display = "none";
};

window.onclick = function (event) {
	if (event.target == addCoursModal) {
		addCoursModal.style.display = "none";
	}
	if (event.target == modifierCoursModal) {
		modifierCoursModal.style.display = "none";
	}
};

function deleteCours(e, id) {
	e.stopPropagation();
	var confirmation = confirm("Voulez-vous vraiment supprimer ce cours ?");
	if (confirmation) {
		window.location.href = "index.php?controller=Admin&action=supprimerCours&id_cours=" + id;
	}
}

function openModifierCoursForm(e, id, titre, description) {
	e.stopPropagation();
	modifierCoursModal.style.display = "block";
	document.getElementById("modifier-titre").value = titre;
	document.getElementById("modifier-description").value = description;
	document.getElementById("modifier-cours-form").setAttribute("action", "index.php?controller=Admin&action=modifierCours&id_cours=" + id);
}
