// Variables
let level = 0;
const maxLevel = 100; // Niveau maximum
const progressBar = document.getElementById("progress");

// Fonction pour mettre à jour la barre de progression
function updateProgressBar() {
    const progress = (level / maxLevel) * 100;
    progressBar.style.width = progress + "%";
    progressBar.textContent = progress.toFixed(0) + "%";
}

// Appel initial pour afficher la barre de progression vide
updateProgressBar();
