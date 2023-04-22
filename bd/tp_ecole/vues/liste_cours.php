<div class="contenu">
    <div class="recherche">
        <form action="" method="post">
            <label for="libelle">Libelle : </label>
            <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($libelle) ?>">
            <input type="submit" name="btnChercher" value="Chercher">
        </form>
    </div>
    <h2>Liste des cours</h2>
    <table>
        <tr>
            <th>Libelle</th>
            <th>Description</th>
            <!--<th>Action</th> -->
        </tr>
        <?php
        foreach ($cours as $cour) {
        ?>
            <tr>
                <td><?= htmlspecialchars($cour["libelle"]) ?></td>

                <td><?= htmlspecialchars($cour["description"]) ?></td>
                <!-- 
                    <td>
                    <?php if (userConneter() && (idUserConneter() == $cour["user_id"])) { ?>
                        <a href="index.php?commande=form_modification_cour&id=<?= $cour['user_id'] ?>">Modifier</a>
                        <a href="index.php?commande=supprimer_cour&id=<?= $cour['user_id'] ?>">Supprimer</a>
                    <?php } ?>
                </td>
                    -->
            </tr>
        <?php } ?>
    </table>
    <!--
    <?php if (userConneter()) { ?>
        <a href="index.php?commande=form_ajout_cour">Creer un cour</a>
    <?php } ?>

    -->
</div>