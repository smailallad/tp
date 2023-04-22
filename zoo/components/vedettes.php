<?php
$animeaux = [
    ["Le carcajou", "caracjou", "caracjou"],
    ["L'ours noir", "oursnoir", "oursnoir"],
    ["Le Lynx", "lynx", "lynx"],
    ["Le cougar", "cougar", "cougar"],
    ["Le Harfang des neiges", "owl", "harfang"],
    ["La girafe", "alexander-ross-myeQ2RH1PX0-unsplash", "girafe"]
];

?>
<section>
    <h2><?= $titreVedette ?> </h2>
    <div class="conteneur-cartes">
        <?php foreach ($animeaux as $animal) { ?>
            <article class="carte">
                <p><?= $animal[0] ?></p>
                <img src="img/<?= $animal[1]; ?>.jpg" alt="<?= $animal[2] ?>">
            </article>
        <?php } ?>
    </div>
</section>