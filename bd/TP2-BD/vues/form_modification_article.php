<div class="formulaire">
    <?php 
        if (isset($message) && $message != ""){?>
        <div class="erreur"><?= $message ?></div>
    <?php } ?>
    <h3>Formulaire de modification d'article</h3>
    <hr>
    <form method="post" action="index.php?commande=modifier_article">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($article["titre"])?>"/>
        </div>
        <div class="form-group">
            <label for="texte">Texte :</label>
            <input type="text" name="texte" value="<?= htmlspecialchars($article["texte"])?>"/>
        </div>
        <div class="form-group">
        <label for="date_article">Date :</label>
            <input type="date" name="date_article" value="<?= $article["date_article"]?>"/>
        </div>
        <div class="form-group">
        <label for="time_article">Heure :</label>
            <input type="time" name="time_article" value="<?= $article["time_article"]?>"/>
        </div>
        <hr>
        <input type="submit" name="btnEnregister" value="Enregistrer"/>
        <a href='index.php'>Retour</a>
        <input type="hidden" name="id_article" value="<?= $article["id_article"]?>">
    </form>
</div>