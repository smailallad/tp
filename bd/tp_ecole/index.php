<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/*
    index.php est le CONTRÔLEUR de notre application de type MVC (modulaire).
    TOUTES les requêtes de notre application, sans aucune exception, que ce soit par un lien ou un formulaire, DEVRONT PASSER EN PREMIER PAR CE FICHIER. Tous les liens et les formulaires auront donc comme destination index.php avec des paramètres dans la query string (après le ?)
    IMPORTANT : Le contrôleur ne contient ni requête SQL, ni HTML/CSS/JS, seulement du PHP.
    Le SQL va strictement dans le modèle. Le HTML va strictement dans les vues.
    */
//réception du paramètre commande, qui peut arriver en GET ou en POST
//nous irons le chercher dans $_REQUEST
//var_dump($_REQUEST);
if (isset($_REQUEST["commande"])) {
    $commande = $_REQUEST["commande"];
} else {
    //assignation de la commande par défaut -- typiquement celle qui mène à votre page d'accueil de votre application
    $commande = "listeCours";
}
//inclure le modele (qui contiendra la connexion à la BD ET les fonctions d'accès à celle-ci)
require_once("modele.php");
//coeur du contrôleur - structure décisionnelle
switch ($commande) {
    case "connexion":
        //on va déclarer les variables dont on a besoin pour cette commande 
        $titre_page = "Connexion";
        if (isset($_REQUEST["nom"])) {
            if (verifierUser($_REQUEST["nom"], $_REQUEST["motpasse"])) {
                header('location:index.php');
            } else {
                $erreur = 1;
            }
        }
        //afficher les vues
        require_once("vues/header.php");
        require_once("vues/connexion.php");
        require_once("vues/footer.php");
        break;
    case "deconnexion":
        deconnecter();
        header('location:index.php');
        break;
    case "listeCours":
        $libelle = isset($_REQUEST["libelle"]) ? $_REQUEST["libelle"] : "";
        $cours = liste_cours($libelle);
        $titre_page = "Liste des cours";
        $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : "";
        //afficher les vues
        require_once("vues/header.php");
        require_once("vues/liste_cours.php");
        require_once("vues/footer.php");
        break;
    case "ajoutCour":
        //procéder à l'insertion et la validation
        if (isset($_REQUEST["btnEnregister"])) {
            $libelle = trim($_REQUEST["libelle"]);
            $description = trim($_REQUEST["description"]);
            $id_user = idUserConneter();

            if ($libelle != "") {
                $erreur = ajouter_cour($libelle, $description);
                if ($erreur != false) {
                    header("Location: index.php?commande=form_ajout_cour&message=" . $erreur);
                    die();
                }
                header("Location: index.php");
                die();
            } else {
                header("Location: index.php?commande=form_ajout_cour&message=Veuillez remplir correctement les champs&libelle=$libelle&texte=$texte");
                die();
            }
        }
        header("Location: index.php");
        break;
    case "modifier_cour":
        if (isset($_REQUEST["btnEnregister"])) {
            $libelle = trim($_REQUEST["libelle"]);
            $texte = trim($_REQUEST["texte"]);
            if ($libelle != "" && $texte != "" && $_REQUEST["date_cour"] != "" && $_REQUEST["time_cour"]) {
                $erreur = modifier_cour($_REQUEST["id_cour"], $libelle, $texte, $_REQUEST["date_cour"], $_REQUEST["time_cour"]);
                if ($erreur != false) {
                    header("Location: index.php?commande=form_modification_cour&id_cour=" . $_REQUEST['id_cour'] . "&message=" . $erreur);
                    die();
                }
                header("Location: index.php");
                die();
            } else {
                header("Location: index.php?commande=form_modification_cour&id_cour=" . $_REQUEST['id_cour'] . "&message=Veuillez remplir correctement les champs");
                die();
            }
        }
        header("Location: index.php");
        break;
    case "supprimer_cour":
        if (!isset($_REQUEST["id_cour"]) && is_numeric($_REQUEST["id_cour"])) {
            header("Location: index.php");
            die();
        }
        $erreur = supprimer_cour($_REQUEST["id_cour"]);
        if ($erreur != false) {
            header("Location: index.php?message=" . $erreur);
            die();
        }
        header("Location: index.php");
        die();
        break;
    case "form_ajout_cour":
        $titre_page = "Ajout d'cour";
        //au cas ou le formulaire a déjà été rempli (il était invalide)
        $cour = [];
        $cour["libelle"] = isset($_REQUEST["libelle"]) ? $_REQUEST["libelle"] : "";
        $cour["texte"] = isset($_REQUEST["texte"]) ? $_REQUEST["texte"] : "";
        $cour["date_cour"] = isset($_REQUEST["date_cour"]) ? $_REQUEST["date_cour"] : "";
        $cour["time_cour"] = isset($_REQUEST["time_cour"]) ? $_REQUEST["time_cour"] : "";
        $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
        require_once("vues/header.php");
        require_once("vues/form_ajout_cour.php");
        require_once("vues/footer.php");
        break;
    case "ajoutUser":
        //procéder à l'insertion et la validation
        if (isset($_REQUEST["btnEnregister"])) {
            $email_user = trim($_REQUEST["email_user"]);
            $password_user = trim($_REQUEST["password_user"]);
            $confirmer_mp = trim($_REQUEST["confirmer_mp"]);
            if ($email_user != "" && $password_user != "" && $confirmer_mp != "") {
                if ($password_user == $confirmer_mp) {
                    $erreur = ajouter_user($email_user, $password_user);
                    if ($erreur != false) {
                        header("Location: index.php?commande=form_ajout_user&message=" . $erreur);
                        die();
                    }
                    header("Location: index.php");
                    die();
                } else {
                    header("Location: index.php?commande=form_ajout_user&message=Le mot de passe est different.");
                    die();
                }
            } else {
                header("Location: index.php?commande=form_ajout_user&message=Veuillez remplir correctement les champs");
                die();
            }
        }
        header("Location: index.php");
        break;
    case "form_ajout_user":
        $titre_page = "Inscription";
        //au cas ou le formulaire a déjà été rempli (il était invalide)
        $user = [];
        $user["email_user"] = isset($_REQUEST["email_user"]) ? $_REQUEST["email_user"] : "";
        $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
        require_once("vues/header.php");
        require_once("vues/form_ajout_user.php");
        require_once("vues/footer.php");
        break;
    case "form_modification_cour":
        //var_dump($_REQUEST);
        if (!isset($_REQUEST["id_cour"]) && is_numeric($_REQUEST["id_cour"])) {
            header("Location: index.php");
            die();
        }
        //on va déclarer les variables dont on a besoin pour cette commande
        //et obtenir les données dans la BD
        $cours = obtenir_cour_par_id($_REQUEST["id_cour"]);

        if (mysqli_num_rows($cours) > 0) {
            $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
            $cour = mysqli_fetch_assoc($cours);
            $titre_page = "Modification d'un cour";
            require_once("vues/header.php");
            require_once("vues/form_modification_cour.php");
            require_once("vues/footer.php");
        } else {
            die("erreur");
            header("Location: index.php");
            die();
        }
        break;
    default:
        header("Location: index.php");
        die();
}
