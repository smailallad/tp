<?php 
    /*
    index.php est le CONTRÔLEUR de notre application de type MVC (modulaire).
    TOUTES les requêtes de notre application, sans aucune exception, que ce soit par un lien ou un formulaire, DEVRONT PASSER EN PREMIER PAR CE FICHIER. Tous les liens et les formulaires auront donc comme destination index.php avec des paramètres dans la query string (après le ?)
    IMPORTANT : Le contrôleur ne contient ni requête SQL, ni HTML/CSS/JS, seulement du PHP.
    Le SQL va strictement dans le modèle. Le HTML va strictement dans les vues.
    */
    //réception du paramètre commande, qui peut arriver en GET ou en POST
    //nous irons le chercher dans $_REQUEST
    //var_dump($_REQUEST);
    if(isset($_REQUEST["commande"])){
        $commande = $_REQUEST["commande"];
    }else{
        //assignation de la commande par défaut -- typiquement celle qui mène à votre page d'accueil de votre application
        $commande = "listeArticles";
    }
     //inclure le modele (qui contiendra la connexion à la BD ET les fonctions d'accès à celle-ci)
    require_once("modele.php");
    //coeur du contrôleur - structure décisionnelle
    switch($commande){
        case "connexion":
            //on va déclarer les variables dont on a besoin pour cette commande 
            $titre_page = "Connexion";
            if (isset($_REQUEST["nom"]))
            {
                if (verifierAuteur($_REQUEST["nom"],$_REQUEST["motpasse"])){
                    header('location:index.php');
                }else{
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
        case "listeArticles":
            $titre = isset($_REQUEST["titre"]) ? $_REQUEST["titre"] : "";
            $texte = isset($_REQUEST["texte"]) ? $_REQUEST["texte"] : "";
            $articles = liste_articles($titre,$texte);
            $titre_page = "Liste des articles";
            $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : "";
            //afficher les vues
            require_once("vues/header.php");
            require_once("vues/liste_articles.php");
            require_once("vues/footer.php");
            break;
        case "ajoutArticle":
            //procéder à l'insertion et la validation
            if(isset($_REQUEST["btnEnregister"]))
            {
                $titre = trim($_REQUEST["titre"]);
                $texte = trim($_REQUEST["texte"]);
                $id_auteur = idAuteurConneter();
                
                if($titre!="" && $texte!="" && $_REQUEST["date_article"]!="" && $_REQUEST["time_article"] && $id_auteur != false) 
                {
                    $erreur = ajouter_article($titre, $texte, $_REQUEST["date_article"], $_REQUEST["time_article"],$id_auteur);
                    if($erreur != false){
                        header("Location: index.php?commande=form_ajout_article&message=" . $erreur);
                        die();
                    }
                    header("Location: index.php");
                    die();
                }
                else 
                {   
                    header("Location: index.php?commande=form_ajout_article&message=Veuillez remplir correctement les champs&titre=$titre&texte=$texte");
                    die();
                }
            }
            header("Location: index.php");
            break;
        case "modifier_article": 
            if(isset($_REQUEST["btnEnregister"]))
            {
                $titre = trim($_REQUEST["titre"]);
                $texte = trim($_REQUEST["texte"]);
                if($titre!="" && $texte!="" && $_REQUEST["date_article"]!="" && $_REQUEST["time_article"]) 
                {
                    $erreur = modifier_article($_REQUEST["id_article"],$titre, $texte, $_REQUEST["date_article"], $_REQUEST["time_article"]);
                    if($erreur != false){
                        header("Location: index.php?commande=form_modification_article&id_article=".$_REQUEST['id_article']."&message=" . $erreur);
                        die();
                    }
                    header("Location: index.php");
                    die();
                }
                else 
                {   
                    header("Location: index.php?commande=form_modification_article&id_article=".$_REQUEST['id_article']."&message=Veuillez remplir correctement les champs");
                    die();
                }
            }
            header("Location: index.php");
            break;
        case "supprimer_article":
            if(!isset($_REQUEST["id_article"]) && is_numeric($_REQUEST["id_article"]))
            {
                header("Location: index.php");
                die();
            }
            $erreur = supprimer_article($_REQUEST["id_article"]);
            if($erreur != false){
                header("Location: index.php?message=" . $erreur);
                die();
            }
            header("Location: index.php");
            die();
            break;
        case "form_ajout_article": 
            $titre_page = "Ajout d'article";
            //au cas ou le formulaire a déjà été rempli (il était invalide)
            $article=[];
            $article["titre"] = isset($_REQUEST["titre"]) ? $_REQUEST["titre"] : "";
            $article["texte"] = isset($_REQUEST["texte"]) ? $_REQUEST["texte"] : "";
            $article["date_article"] = isset($_REQUEST["date_article"]) ? $_REQUEST["date_article"] : "";
            $article["time_article"] = isset($_REQUEST["time_article"]) ? $_REQUEST["time_article"] : "";
            $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
            require_once("vues/header.php");
            require_once("vues/form_ajout_article.php");
            require_once("vues/footer.php");
            break;            
        case "ajoutAuteur":
            //procéder à l'insertion et la validation
            if(isset($_REQUEST["btnEnregister"]))
            {
                $nom_auteur = trim($_REQUEST["nom_auteur"]);
                $password_auteur = trim($_REQUEST["password_auteur"]);
                $confirmer_mp = trim($_REQUEST["confirmer_mp"]);
                if($nom_auteur!="" && $password_auteur!="" && $confirmer_mp!=""){
                    if ($password_auteur == $confirmer_mp){
                        $erreur = ajouter_auteur($nom_auteur, $password_auteur);
                        if($erreur != false){
                            header("Location: index.php?commande=form_ajout_auteur&message=" . $erreur);
                            die();
                        }
                        header("Location: index.php");
                        die();
                    }else{
                        header("Location: index.php?commande=form_ajout_auteur&message=Le mot de passe est different.");
                    die();
                    }
                }else{
                    header("Location: index.php?commande=form_ajout_auteur&message=Veuillez remplir correctement les champs");
                    die();
                }
            }
            header("Location: index.php");
            break;
        case "form_ajout_auteur": 
            $titre_page = "Inscription";
            //au cas ou le formulaire a déjà été rempli (il était invalide)
            $auteur=[];
            $auteur["nom_auteur"] = isset($_REQUEST["nom_auteur"]) ? $_REQUEST["nom_auteur"] : "";
            $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
            require_once("vues/header.php");
            require_once("vues/form_ajout_auteur.php");
            require_once("vues/footer.php");
            break; 
        case "form_modification_article":
            //var_dump($_REQUEST);
            if(!isset($_REQUEST["id_article"]) && is_numeric($_REQUEST["id_article"]))
            {
                header("Location: index.php");
                die();
            }
            //on va déclarer les variables dont on a besoin pour cette commande
            //et obtenir les données dans la BD
            $articles = obtenir_article_par_id($_REQUEST["id_article"]);
            
            if(mysqli_num_rows($articles) > 0)
            {
                $message = isset($_REQUEST["message"]) ? $_REQUEST["message"] : null;
                $article = mysqli_fetch_assoc($articles);
                $titre_page = "Modification d'un article"; 
                require_once("vues/header.php");
                require_once("vues/form_modification_article.php");
                require_once("vues/footer.php");
            }
            else{ 
                die("erreur");
                header("Location: index.php");
                die();
            }
            break;
        default:
            header("Location: index.php");
            die();
    }
