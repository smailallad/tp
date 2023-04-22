window.addEventListener("load", function () {
    const gabarit = document.querySelector(".gabarit")
    const liste = document.querySelector(".liste-clone")

    //Ecouteurs d'événments
    document.getElementById("aller-retour").addEventListener("click", fAllerRetour)
    document.getElementById("retour").addEventListener("click", fRetour)
    document.getElementById("continuer").addEventListener("click", fContinuer)
    
    //On ajoute un écouteur d'événement sur chaque INPUT
    const champs = this.document.querySelectorAll("input")
    for (const champ of champs) {
        champ.addEventListener("change", fValeurChanger)
    }

    //Fonctions
    // Changement valeur Check box aller retour
    function fAllerRetour(evenement) {
        const DivAllerRetour = document.getElementById("div-retour")
        const CheckBoxAllerRetour = document.getElementById("aller-retour")
        const DateRetour = document.getElementById("date-retour")
        DateRetour.required = CheckBoxAllerRetour.checked
        if (DateRetour.required){
            if (DivAllerRetour.classList.contains("invisible")) {
                DivAllerRetour.classList.remove("invisible")
            }
        }else{
            if (!DivAllerRetour.classList.contains("invisible")) {
                DivAllerRetour.classList.add("invisible")
            }
        }
    }
   // Pour continuer
    function fContinuer(event){
        const form = document.getElementById("formulaire")
        const pageActuelle = fPageActuelle()

        if( form.checkValidity() ){
            //form.reportValidity()
            if (pageActuelle == 1 ){
                document.getElementById("page1").classList.add("invisible")
                document.getElementById("page2").classList.remove("invisible")
            }else if (pageActuelle == 2){
                document.getElementById("page2").classList.add("invisible")
                document.getElementById("page3").classList.remove("invisible")
            }
            fValeurChanger(null)
            event.preventDefault()
            //    formulaire.submit()
            //    formulaire.reset()//Pour réinitialiser le formulaire au besoin
        }
    }
    // Retour
    function fRetour(event){
        const form = document.getElementById("formulaire")
        if( form.checkValidity() ){
            const pageActuelle = fPageActuelle()
            if (pageActuelle == 2){
                document.getElementById("page1").classList.remove("invisible")
                document.getElementById("page2").classList.add("invisible")
                document.getElementById("page3").classList.add("invisible")
            }else if (pageActuelle == 3){
                document.getElementById("page1").classList.add("invisible")
                document.getElementById("page2").classList.remove("invisible")
                document.getElementById("page3").classList.add("invisible")
            }
            event.preventDefault()
            fValeurChanger(null)
        }
    }
    //Changement valeur des inputs
    function fValeurChanger(event){
        if (event != null){
            const input = event.target.getAttribute('id')
            if (input == "nbr-billet"){
                const nbrBillet = document.getElementById('nbr-billet').value
                if ((nbrBillet > liste.childElementCount) && (nbrBillet <=5)){
                    fAjouteRangee()
                }else if (nbrBillet>=1){
                    fRetireRangee()
                }
            }
        }
        const pageActuelle = fPageActuelle()
        if (pageActuelle == 1){
            document.getElementById("retour").setAttribute("disabled", "disabled")
            document.getElementById('retour').classList.add("disabled")
            if (document.getElementById('nom').checkValidity() && 
            document.getElementById('email').checkValidity() &&
            document.getElementById('date-depart').checkValidity() &&
            ((document.getElementById('aller-retour').checked && document.getElementById('date-retour').checkValidity()) || !document.getElementById('aller-retour').checked)
            )
            {
                document.getElementById('continuer').removeAttribute("disabled")
                document.getElementById('continuer').classList.remove("disabled")
            }else{
                document.getElementById('continuer').setAttribute("disabled", "disabled")
                document.getElementById('continuer').classList.add("disabled")
            }
        }else if (pageActuelle == 2){
            
            document.getElementById('retour').removeAttribute("disabled")
            document.getElementById('retour').classList.remove('disabled')
            document.getElementById('continuer').removeAttribute("disabled")
            document.getElementById('continuer').classList.remove('disabled')
        }else{
            let resumer = document.getElementById('page3')
            let contenu ="<h4>Etape 4 - Resume </h4>"
            const nom = document.getElementById('nom').value
            const email = document.getElementById('email').value
            const destination = document.getElementById('destination').value
            const dateDepart = new Date(document.getElementById('date-depart').value).toLocaleDateString("fr")
            contenu += "<h5>Informations personnelles</h5>"
            contenu += `<p>${nom}</p>`
            contenu += `<p>${email}</p><br>`
            contenu += "<h5>Destination</h5>"
            contenu += `<p>${destination}</p>`
            contenu += `<div class="gauche">`
            contenu += `<p>Aller</p>`
            contenu += `<p>${dateDepart}</p>`
            contenu += `</div>`
            if (document.getElementById('aller-retour').checked){
                const dateRetour =new Date(document.getElementById('date-retour').value).toLocaleDateString("fr")
                contenu += `<div class="gauche">`
                contenu += `<p>Retour</p>`
                contenu += `<p>${dateRetour}</p>`
                contenu += `</div>`
            }
            contenu += "<div class='inline'><h5>Billets</h5>"
            const boutonsRadios = liste.querySelectorAll("input[type='radio']")
            for (let bouton of boutonsRadios) {
                //console.log(bouton)
                if (bouton.checked){
                    contenu += `<p>Billet ${bouton.dataset.index} - Tarif ${bouton.value}</p>`
                    //console.log(bouton.dataset.index , bouton.value)
                }
                //console.log(bouton.name +" => "+ bouton.checked)
                //bouton.dataset.index = nombreBillet.toString()
            }
            contenu += "</div>"
            resumer.innerHTML = contenu
            
            document.getElementById('retour').removeAttribute("disabled")
            document.getElementById('retour').classList.remove('disabled')
            document.getElementById("continuer").setAttribute("disabled", "disabled")
            document.getElementById('continuer').classList.add('disabled')
        }
    }
    // Retour page actuelle
    function fPageActuelle(){
        if (!document.getElementById("page1").classList.contains("invisible"))
        return 1
        else if (!document.getElementById("page2").classList.contains("invisible"))
        return 2
        else if (!document.getElementById("page3").classList.contains("invisible"))
        return 3
        else{
            alert("erreur renvoi de page ")
        }
    }

    function fAjouteRangee() {
        if (liste.childElementCount < 5){
            nombreBillet = document.getElementById('nbr-billet').value
            const clone = gabarit.cloneNode(true)
            const boutonsRadios = clone.querySelectorAll("input[type='radio']")
            let ps = clone.querySelectorAll("p")
            clone.classList.remove("invisible")
            for (let p of ps){
                p.textContent = "Billet N: " + nombreBillet
            }
            
            //const coche = clone.querySelector("input[type='radio']:checked")

            for (let bouton of boutonsRadios) {
                bouton.name = "radio" + nombreBillet
                bouton.dataset.index = nombreBillet.toString()

                //bouton.addEventListener("change", function (evenement) {
                //    const declencheur = evenement.target
                //    console.log(declencheur, declencheur.value)
                //})
            }

            liste.append(clone)
        }
    }

    function fRetireRangee() {
        //Vérification si la liste elle a plus d'un element
        if (liste.childElementCount>1) {
            liste.lastElementChild.remove()
        }
    }

    // DESACTIVER LES BOUTONS AU CHRGEMENT DE LA PAGE
    document.getElementById('retour').setAttribute("disabled","disabled")
    document.getElementById('retour').classList.add("disabled")
    
    document.getElementById('continuer').setAttribute("disabled","disabled")
    document.getElementById('continuer').classList.add("disabled")    
    
    // RENITIALISER LE FORMULAIRE AU CHARGEMENT DE LA PAGE
    this.document.getElementById('formulaire').reset()
    // DESACTIVER OU ACTIVER DATE ALLER ET RETOUR
    fAllerRetour()

    // AJOUTER UN ELEMENT DANS LA LISTE RADIO
    fAjouteRangee()

    // VERFIER LES INPUTs
    fValeurChanger(null)
})
    


