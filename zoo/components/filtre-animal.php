<?php
$bouttons = ["Voir tous", "Amphibien", "Oiseau", "Canin", "Félin", "Mustélidé"];
?>
<section>
    <h2>Filtrer par type d’animal</h2>
    <div class="btn">
        <?php foreach ($bouttons as $boutton) { ?>
            <button> <?= $boutton ?> </button>
        <?php } ?>
    </div>
</section>
<section>
    <div class="grille-deux-par-deux">
        <picture>
            <img src="img/cougar.jpg" alt="cougar">
        </picture>
        <div class="conteneur-grille">
            <p>Découvrez tous les animaux auxquels vous aurez accès en vous baladant dans notre zoo en forêt.</p>
        </div>
    </div>
</section>
<section>
    <div class="grille">
        <h2>Animaux en vedette</h2>
        <div class="grille-liens">
            <div>
                <h4>Le carcajou</h4>
                <a href="#">Le Glouton ou Carcajou, est un mammifère au régime alimentaire omnivore.</a>
            </div>
            <div>
                <h4>L’ours noir</h4>
                <a href="#">L’Ours noir, aussi appelé baribal, est l’ours le plus commun en Amérique du Nord.
                    Découvrez l’ours noir</a>
            </div>
            <div>
                <h4>Le lynx</h4>
                <a href="#">Les lynx sont aisément reconnaissables à leur face ornée de favoris.
                    Découvrez le lynx</a>
            </div>
        </div>
    </div>
</section>