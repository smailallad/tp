<?php 
/*
modele.php est le fichier qui représente notre modèle dans notre architecture MVC modulaire. C'est donc dans ce fichier que nous retrouverons TOUTES nos requêtes SQL sans AUCUNE EXCEPTION. C'est aussi ici que se trouvera LA connexion à la base de données ET les informations de connexion relatives à celles-ci (qui pourraient plus tard être mises dans un fichier de configuration séparé ... voir les frameworks)
*/
//à modifier pour webdev éventuellement
define("SERVER", "localhost");
define("USERNAME", "test");
define("PASSWORD", "testtest");
define("DBNAME", "blog_tp2");
function connectDB(){
    //se connecter à la base de données
    $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
    if(!$c)
        die("Erreur de connexion. MySQLi : " . mysqli_connect_error());
    //s'assurer que la connexion traite le UTF8
    mysqli_query($c, "SET NAMES 'utf8'");
    return $c;
}
$connexion = connectDB();
function verifierAuteur($nom,$motpasse){
    if (strlen($nom) == 0 || strlen($motpasse)==0){
        return false;
    }
    //Recupere l'auteur dans la BD
    global $connexion;
    /* Crée une requête préparée */
    if ($requete = mysqli_prepare($connexion, "SELECT id_auteur,password_auteur FROM auteur WHERE nom_auteur=?")) {
        /* Lecture des marqueurs */
        mysqli_stmt_bind_param($requete, "s", $nom);
        /* Exécution de la requête */
        mysqli_stmt_execute($requete);
        /* Lecture des variables résultantes */
        mysqli_stmt_bind_result($requete, $id_auteur,$mp);
        /* Récupération des valeurs */
        if (mysqli_stmt_fetch($requete) !== null){
            /* Verifier le mot de passe dans le cas mot de passe en dure */
            /*if ($motpasse == $mp){
                if (session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION["auteur"] = $nom;
                $_SESSION["id_auteur"] = $id_auteur;
                return true;
            }*/
            /* Verifier le mot de passe dans le cas mot de passe crypter */
            
            if (password_verify($motpasse,$mp)){
                if (session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION["auteur"] = $nom;
                $_SESSION["id_auteur"] = $id_auteur;
                return true;
            }
            
        }
    }else{
        die("Erreur requette.");
    }
    return false;
}
function auteurConneter(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    return isset($_SESSION["auteur"]) ? $_SESSION["auteur"] : false;
}
function idAuteurConneter(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    return isset($_SESSION["id_auteur"]) ? $_SESSION["id_auteur"] : false;
}
function deconnecter(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    session_unset();
}
function ajouter_auteur($nom_auteur,$password_auteur){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "INSERT INTO auteur (nom_auteur, password_auteur) VALUES ( ? , ?)";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if($reqPrep){
        //Crypter le mot de passe
        $password_auteur = password_hash($password_auteur, PASSWORD_DEFAULT);
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ss",$nom_auteur, $password_auteur);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function ajouter_article($titre, $texte, $date_article, $time_article, $id_auteur){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "INSERT INTO article (titre, texte, date_article, time_article, id_auteur) VALUES ( ? , ? , ? , ? , ?)";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ssssi",$titre, $texte, $date_article, $time_article, $id_auteur);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function modifier_article($id_article,$titre, $texte, $date_article, $time_article){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "UPDATE article SET titre=?,texte=?,date_article=?,time_article=? WHERE id_article = ?";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ssssi",$titre, $texte, $date_article, $time_article, $id_article);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function supprimer_article($id_article){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "DELETE FROM article WHERE id_article = ? ";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if($reqPrep)
    {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "i", $id_article);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function liste_articles($titre,$texte){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    $sql = "SELECT * FROM article INNER JOIN auteur ON article.id_auteur = auteur.id_auteur ";
    if ($titre != ""){
        $sql .= " WHERE titre LIKE '$titre%' ";
        if ($texte != ""){
            $sql .= " AND texte LIKE '$texte%' ";
        }
    }elseif ($texte != ""){
        $sql .= " WHERE texte LIKE '$texte%' ";
    }
    $sql .= " ORDER BY id_article DESC";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    $result = $requete->get_result();
    return $result;
}
function obtenir_article_par_id($id_article){
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    $sql = "SELECT * FROM article WHERE id_article = $id_article ";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    $result = $requete->get_result();
    return $result;
}
