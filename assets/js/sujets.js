var addSujetModal = document.getElementById("add-sujet-modal");
var addSujetTrigger = document.getElementById("add-sujet-trigger");
var addSujetClose = document.getElementsByClassName("close")[0];
console.log(addSujetClose);
addSujetTrigger.onclick = function () {
    addSujetModal.style.display = "block";
};

addSujetClose.onclick = function () {
    addSujetModal.style.display = "none";
};


window.onclick = function (event) {
    if (event.target == addSujetModal) {
        addSujetModal.style.display = "none";
    }
};



    

