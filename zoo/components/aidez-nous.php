<?php
$liens = [
    "Participez à notre programme de survie solitaire.",
    "Contribuez à l'essor de l'ours noir.",
    "Découvrez nos initiatives de protection du caribou."
];
?>
<section>
    <div class="grille">
        <h2>Aidez-nous à préserver la faune québécoise et sournoise!</h2>
        <div class="grille-liens">
            <?php foreach ($liens as $key => $lien) {
                if ($key != 0) { ?>
                    <hr>
                <?php } ?>
                <a href="#"><?= $lien ?></a>
            <?php } ?>
        </div>
    </div>
</section>