<?php //require_once("../modele.php") 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre_page ?></title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php if ($titre_page != "Connexion") { ?>
        <nav>
            <?php if (userConneter()) { ?>
                <p>
                    Bonjour <?= userConneter(); ?> ,
                    <a href="index.php?commande=deconnexion">Deconnexion</a>
                </p>
            <?php } else { ?>
                <a href="index.php?commande=connexion">Connexion</a>
            <?php } ?>
        </nav>
        <?php if (isset($messageP) && $messageP != "") { ?>
            <div class="message"><?= $messageP ?></div>
    <?php }
    } ?>