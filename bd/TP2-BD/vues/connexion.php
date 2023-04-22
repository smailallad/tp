<div class="connexion">
    <?php if (isset($erreur)) {?>
        <div class="erreur">
            Auteur incorrecte.
        </div>
    <?php } ?>
    <form action="" method="post">
        <p><input type="text" name="nom" id="nom" placeholder="Nom auteur"></p>
        <p><input type="password" name="motpasse" id="motpasse" placeholder="Mot de passe"></p>
        <hr>
        <p>
            <input type="submit" name="btnConnecter" value="Connecter">
            <a href="index.php?commande=form_ajout_auteur">Inscription</a>
        </p>
    </form>
</div>