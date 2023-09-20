// Attend que la page soit chargée
    document.addEventListener('DOMContentLoaded', function () {
        // Affiche la pop-up
        document.getElementById('modal').style.display = 'block';
        
        // Lecture de l'audio
        let myAudio = document.querySelector('#audio');
        myAudio.play();
    });

    // Gestionnaire d'événement pour fermer la pop-up
    document.getElementById('modal-close').addEventListener('click', function (e) {
        e.preventDefault(); // Empêche le lien de rediriger
        document.getElementById('modal').style.display = 'none';
    });
