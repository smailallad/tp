<?php
$footItems = [
    ["Services aux écoles", "Partenaires", "Informations"],
    ["Don ponctuel", "Don mensuel", "Autres méthodes"],
    ["A propos", "Carrières", "Equipe"],
    ["Activités et événements", "Activités familiales"]
];
?>
<footer>
    <nav>
        <!-- logo -->
        <?php include "components/logo.php" ?>
        <?php foreach ($footItems as $footItem) { ?>
            <div class="nav-menu en-bas" role="menubar">
                <?php foreach ($footItem as $Item) { ?>
                    <a href="#" role="menuitem"><?= $Item ?> </a>
                <?php } ?>
            </div>
        <?php  } ?>
    </nav>
    <div>
        <small>8765 rue JeNesaisPas,QC ,H1H Z9Z</small>
    </div>
    <?php include "assets/icones/socialMedia.php" ?>

</footer>