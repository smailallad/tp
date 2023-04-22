<div class="inscription">
    <?php
    if (isset($message) && $message != "") { ?>
        <div class="erreur"><?= $message ?></div>
    <?php } ?>
    <h3>Formulaire d'insciprion</h3>
    <hr>
    <form method="post" action="index.php?commande=ajoutUser">
        <div class="form-group">
            <label for="email_user">Email :</label>
            <input type="email" name="email_user" value="<?= htmlentities($user["email_user"]) ?>" />
        </div>
        <div class="form-group">
            <label for="password_user">Mot de passe :</label>
            <input type="password" name="password_user" />
        </div>
        <div class="form-group">
            <label for="confirmer_mp">Confimer le mot de passe :</label>
            <input type="password" name="confirmer_mp" />
        </div>
        <hr>
        <input type="submit" name="btnEnregister" value="Enregistrer" />
        <a href='index.php'>Retour</a>
    </form>
</div>