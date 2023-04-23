<?php
/*
modele.php est le fichier qui représente notre modèle dans notre architecture MVC modulaire. C'est donc dans ce fichier que nous retrouverons TOUTES nos requêtes SQL sans AUCUNE EXCEPTION. C'est aussi ici que se trouvera LA connexion à la base de données ET les informations de connexion relatives à celles-ci (qui pourraient plus tard être mises dans un fichier de configuration séparé ... voir les frameworks)
*/
//à modifier pour webdev éventuellement
/*
CREATE USER 'test'@'localhost' IDENTIFIED BY 'test';
GRANT ALL PRIVILEGES ON *.* TO 'test'@'localhost';
FLUSH PRIVILEGES;
*/
define("SERVER", "localhost");
define("USERNAME", "test");
define("PASSWORD", "test");
define("DBNAME", "bd_ecole");
function connectDB()
{
    //se connecter à la base de données
    $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
    if (!$c)
        die("Erreur de connexion. MySQLi : " . mysqli_connect_error());
    //s'assurer que la connexion traite le UTF8
    mysqli_query($c, "SET NAMES 'utf8'");
    return $c;
}
$connexion = connectDB();
function verifierUser($email, $motpasse)
{
    if (strlen($email) == 0 || strlen($motpasse) == 0) {
        return false;
    }
    //Recupere l'user dans la BD
    global $connexion;
    /* Crée une requête préparée */
    if ($requete = mysqli_prepare($connexion, "SELECT email,password FROM users WHERE email=?")) {
        /* Lecture des marqueurs */
        mysqli_stmt_bind_param($requete, "s", $email);
        /* Exécution de la requête */
        mysqli_stmt_execute($requete);
        /* Lecture des variables résultantes */
        mysqli_stmt_bind_result($requete, $id, $mp);
        /* Récupération des valeurs */
        if (mysqli_stmt_fetch($requete) !== null) {
            /* Verifier le mot de passe dans le cas mot de passe crypter */

            if (password_verify($motpasse, $mp)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION["user_email"] = $email;
                $_SESSION["user_id"] = $id;
                return true;
            }
        }
    } else {
        die("Erreur requette.");
    }
    return false;
}
function userConneter()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : false;
}
function idUserConneter()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : false;
}
function deconnecter()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
}
function ajouter_user($email, $password)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "INSERT INTO users (email, password) VALUES ( ? , ?)";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if ($reqPrep) {
        //Crypter le mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ss", $email, $password);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function ajouter_cour($titre, $texte)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "INSERT INTO cour (titre, texte, date_cour, time_cour, id) VALUES ( ? , ? , ? , ? , ?)";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if ($reqPrep) {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ssssi", $titre, $texte, $date_cour, $time_cour, $id);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function modifier_cour($id_cour, $titre, $texte, $date_cour, $time_cour)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "UPDATE cour SET titre=?,texte=?,date_cour=?,time_cour=? WHERE id_cour = ?";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if ($reqPrep) {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "ssssi", $titre, $texte, $date_cour, $time_cour, $id_cour);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function supprimer_cour($id_cour)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    //on prépare la requête en mettant des ? à la place des paramètres qui viennent de l'usager
    $requete = "DELETE FROM cour WHERE id_cour = ? ";
    //on prépare la requête
    $reqPrep = mysqli_prepare($connexion, $requete);
    //si la requête préparée fonctionne 
    if ($reqPrep) {
        //faire le lien
        mysqli_stmt_bind_param($reqPrep, "i", $id_cour);
        //exécute la requête
        mysqli_stmt_execute($reqPrep);
        // return erreur si ya erreur et true si pas d'erreur
        $erreur = mysqli_stmt_error($reqPrep);
        return  $erreur != "" ? $erreur : false;
    }
    return "Erreur.";
}
function liste_cours($libelle)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    $sql = "SELECT * FROM courses";
    if ($libelle != "") {
        $sql .= " WHERE libelle LIKE '%$libelle%' ";
    }
    $sql .= " ORDER BY id DESC";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    $result = $requete->get_result();
    return $result;
}
function obtenir_cour_par_id($id_cour)
{
    //obtenir la connexion définie plus haut (à l'extérieur de la fonction)
    global $connexion;
    $sql = "SELECT * FROM cour WHERE id_cour = $id_cour ";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    $result = $requete->get_result();
    return $result;
}
