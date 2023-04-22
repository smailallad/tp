<div class="formulaire">
    <?php
    if (isset($message) && $message != "") { ?>
        <div class="erreur"><?= $message ?></div>
    <?php } ?>
    <h3>Formulaire de modification d'cour</h3>
    <hr>
    <form method="post" action="index.php?commande=modifier_cour">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($cour["titre"]) ?>" />
        </div>
        <div class="form-group">
            <label for="texte">Texte :</label>
            <input type="text" name="texte" value="<?= htmlspecialchars($cour["texte"]) ?>" />
        </div>
        <div class="form-group">
            <label for="date_cour">Date :</label>
            <input type="date" name="date_cour" value="<?= $cour["date_cour"] ?>" />
        </div>
        <div class="form-group">
            <label for="time_cour">Heure :</label>
            <input type="time" name="time_cour" value="<?= $cour["time_cour"] ?>" />
        </div>
        <hr>
        <input type="submit" name="btnEnregister" value="Enregistrer" />
        <a href='index.php'>Retour</a>
        <input type="hidden" name="id_cour" value="<?= $cour["id_cour"] ?>">
    </form>
</div>