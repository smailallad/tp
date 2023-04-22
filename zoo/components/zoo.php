<?php
$animeaux = [
    ["economiser", "ecusson", "Recevez un écusson!!", "Promotions"],
    ["histoire", "village", "Un village plein d’histoires", "Nos articles"],
    ["cougar2", "cougar", "Le cougar québécois", "Nos animaux"],
];
?>
<section>
    <h2>Apprenez-en plus sur le zoo Val-Jalbert !</h2>
    <div class="conteneur-cartes">
        <?php foreach ($animeaux as $animal) { ?>
            <div class="carte-article">
                <img src="img/<?= $animal[0] ?>.jpg" alt="<?= $animal[1] ?>">
                <div>
                    <h3><?= $animal[2] ?></h3>
                    <a class="bouton" href=""><?= $animal[3] ?></a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>