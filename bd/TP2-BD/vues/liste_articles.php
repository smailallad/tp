<div class="contenu">
    <div class="recherche">
        <form action="" method="post">
            <label for="titre">Titre : </label>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($titre) ?>">
            <label for="texte">Texte : </label>
            <input type="text" name="texte" id="text" value="<?= htmlspecialchars($texte) ?>">
            <input type="submit" name="btnChercher" value="Chercher">
        </form>
    </div>
    <h2>Liste des articles</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Texte</th>
            <th>Auteur</th>
            <th>Action</th>
        </tr>
        <?php 
        foreach($articles as $article){
            ?>
            <tr>
                <td><?= htmlspecialchars($article["titre"]) ?></td>
                
                <td><?= htmlspecialchars($article["texte"]) ?></td>
                <td><?= htmlspecialchars($article["nom_auteur"]) ?></td>
                <td>
                    <?php if (auteurConneter() && (idAuteurConneter() == $article["id_auteur"])){?>
                        <a href="index.php?commande=form_modification_article&id_article=<?= $article['id_article']?>">Modifier</a>
                        <a href="index.php?commande=supprimer_article&id_article=<?= $article['id_article']?>">Supprimer</a>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if (auteurConneter()) {?>
    <a href="index.php?commande=form_ajout_article">Creer un article</a>
    <?php } ?>
</div>