export class Tache {
    constructor(nomTache, listeDestination) {
        this.parent = listeDestination;
        this.nom = nomTache;

        if (this.parent === null) {
            return console.warn("Aucun parent sélectionné");
        }

        this.Initialiser();
    }

    Initialiser() {
        // Cloner gabarit
        const gabaritTache = document.querySelector(".gabarit");

        //Cloner
        this.conteneur = gabaritTache.cloneNode(true);
        this.conteneur.classList.remove("invisible");
        //Recupérer les éléments interactifs
        this.labelTache = this.conteneur.querySelector(".nom-tache");
        const bouttonSupprimer = this.conteneur.querySelector(".bouton-supprimer");
        bouttonSupprimer.addEventListener('click',function(event) {
            this.Supprimer()
        }.bind(this));


        //Ajouter des écouteurs sur les éléments
        //La méthode bind permet de réattribuer la valeur de "this". Vous ne pourrez pas avoir accès 

        this.conteneur.addEventListener("mouseenter", function(event) {
            // console.log(this, event.currentTarget);
            this.MettreEnSurbrillance(true);
        }.bind(this));

        this.conteneur.addEventListener("mouseleave", function(event) {
            this.MettreEnSurbrillance(false);
        }.bind(this));




        // ========= À faire supprimer la tâche au clic du bouton ===========
        // ========= À faire rayer la tâche au changement de la boite à cocher ===========

        //Modifier les éléments
        this.labelTache.innerText = this.nom;

        //Ajouter au parent
        this.parent.append(this.conteneur);

    }

    MettreEnSurbrillance(enSubrillance) {
        this.conteneur.dataset.survol = enSubrillance;
    }

    Cocher() {
        // À faire par vous-même
    }

    AnimerSupprimer() {
        //Ne pas faire tout de suite
    }

    Supprimer() {
        //console.log(this.conteneur)
        this.conteneur.remove();
    }
}