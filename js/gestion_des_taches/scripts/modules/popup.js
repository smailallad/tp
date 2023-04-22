const popupConteneurPrincipal = document.querySelector(".popup-conteneur");
const popupBg = popupConteneurPrincipal.querySelector(".bg");
const popupBoutonFermer = popupConteneurPrincipal.querySelector(".bouton-fermer");

//const popupDeclencheur = document.querySelector(".popup-declencheur");

export function InitialisationPopup() {
    //popupDeclencheur.addEventListener("click", AfficherPopup);

    popupBoutonFermer.addEventListener("click", CacherPopup);
    popupBg.addEventListener("click", CacherPopup);
    AfficherPopup();
}

function AfficherPopup() {
    popupConteneurPrincipal.classList.remove("invisible");
    //popupDeclencheur.removeEventListener("click", AfficherPopup);

    // À faire --- Ajouter un timeout
    window.setTimeout(CacherPopup, 3000);
   
}

function CacherPopup() {
    popupConteneurPrincipal.classList.add("invisible");
}