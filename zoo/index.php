<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Val-Jalbert</title>
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="./assets/main.css">
</head>

<body>
    <!-- ================================================== -->
    <!-- BODY DU SITE -->


    <!-- NAVBAR -->
    <!-- navigation =============================================== -->
    <?php include "components/header.php" ?>
    <main>
        <!-- SECTION BANNIER -->
        <?php include "components/bannier.php" ?>

        <!-- EN APPREND PLUS SUR ZOO -->
        <?php include "components/zoo.php" ?>

        <!-- DEVENEZ MEMBRE -->
        <?php include "components/devenez-membre.php" ?>

        <!-- VEDETTES -->
        <?php $titreVedette = "Nos vedettes!"; ?>
        <?php include "components/vedettes.php" ?>

        <!-- AIDEZ NOUS -->
        <?php include "components/aidez-nous.php" ?>
    </main>
    <!-- DFOOTER -->
    <?php include "components/footer.php" ?>

    <!-- ================================================== -->

</body>

</html>