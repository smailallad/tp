<?php
// Définir les items de notre navigation  
$navItems = [
    ["Accueil", "index.php"],
    ["Portail des animaux", "Portail.php"],
    [
        "Préserver la faune",
        [
            ["Parrainez un animal", "#"],
            ["Programme éducatif", "#"],
            ["Nos initiatives", "#"]
        ]
    ],
];
$navItemsBilletterie = ["Billetterie", "#"];
?>
<nav>
    <!-- logo -->
    <?php include "components/logo.php" ?>
    <!-- certains liens on changé de nom afin de mieux parraitre sur la nav -->
    <div class="nav-menu" role="menubar">
        <?php foreach ($navItems as $item) {
            if (!is_array($item[1])) { ?>
                <a href="<?= $item[1] ?>" role="menuitem"><?= $item[0] ?></a>
            <?php
            } else { ?>
                <div class="nav-sousmenu" role="menubar">
                    <span><?= $item[0] ?> </span>
                    <div>
                        <?php foreach ($item[1] as $lien) { ?>
                            <a href="<?= $lien[1] ?>" role="menuitem"><?= $lien[0] ?></a>
                        <?php
                        } ?>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>
    <div>
        <a href="<?= $navItemsBilletterie[1] ?>" class="billetterie"><?= $navItemsBilletterie[0] ?></a>
    </div>
</nav>