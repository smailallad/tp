<div class="connexion">
    <?php if (isset($erreur)) { ?>
        <div class="erreur">
            User incorrecte.
        </div>
    <?php } ?>
    <form action="" method="post">
        <p><input type="text" name="nom" id="nom" placeholder="email user"></p>
        <p><input type="password" name="motpasse" id="motpasse" placeholder="Mot de passe"></p>
        <hr>
        <p>
            <input type="submit" name="btnConnecter" value="Connecter">
            <a href="index.php?commande=form_ajout_user">Inscription</a>
        </p>
    </form>
</div>