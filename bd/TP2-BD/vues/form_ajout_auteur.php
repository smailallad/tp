<div class="inscription">
    <?php 
        if (isset($message) && $message != ""){?>
        <div class="erreur"><?= $message ?></div>
    <?php } ?>
    <h3>Formulaire d'insciprion</h3>
    <hr>
    <form method="post" action="index.php?commande=ajoutAuteur">
        <div class="form-group">
            <label for="nom_auteur">Nom :</label>
            <input type="text" name="nom_auteur" value="<?= htmlentities($auteur["nom_auteur"])?>"/>
        </div>
        <div class="form-group">
            <label for="password_auteur">Mot de passe :</label>
            <input type="password" name="password_auteur"/>
        </div>
        <div class="form-group">
        <label for="confirmer_mp">Confimer le mot de passe :</label>
            <input type="password" name="confirmer_mp"/>
        </div>
        <hr>
        <input type="submit" name="btnEnregister" value="Enregistrer"/>
        <a href='index.php'>Retour</a>
    </form>
</div>