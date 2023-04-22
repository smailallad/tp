<?php
$noms = ['smail', 'wili', 'ines', 'silya', 'alissa'];
$i = 1;
foreach ($noms as $nom) {
    $password = password_hash($nom, PASSWORD_DEFAULT);
    echo ("('" . $i . "','" . $nom . "','" . $password . "'),");
    echo ('<br>');
    $i++;
}
