//Import module de la popup
import { InitialisationPopup } from "./modules/popup.js";
//Import module d'une tache
import { Tache } from "./classes/Tache.js";

//Variables globales
const liste = document.querySelector(".liste-taches");
const bouton = document.querySelector(".bouton-nouvelle-tache");

//Écouteurs d'événements
function initialisation() {
    const liste = document.querySelector(".liste-taches");
    const bouton = document.querySelector(".bouton-nouvelle-tache");
    bouton.addEventListener("click", AjouterTache);
}

//Fonctions
function AjouterTache() {
    //Vous devez récupérer le nom de la tâche par vous-même
    let nomTache = document.querySelector("input[type='text']").value;
    if (nomTache.length > 0) {
        new Tache(nomTache, liste);
        InitialisationPopup();
    }
    document.querySelector("input[type='text']").value = "";
}


//Exécution du code de la page
initialisation();