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
        <!-- Portail des animaux -->
        <?php $titreVedette = "Portail des animaux"; ?>
        <?php include "components/vedettes.php" ?>

        <!-- Filtrer par type d’animal -->
        <?php include "components/filtre-animal.php" ?>

    </main>
    <!-- Footer -->
    <?php include "components/footer.php" ?>
</body>

</html>