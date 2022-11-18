<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index.css">
    <title>Mon compte</title>
</head>

<body>
    <?php
    if (isset($_SESSION['id_util'])) {
    ?>
        <?php include('../../header.php') ?>
        <div class=centre>
            <?php
            if (isset($_SESSION['id_util']) || true) {
            ?>
                <button onClick="parent.location.href='../../backend/compte/parsecsv.php'" type="button">Recharger la base de données</button>
            <?php
            } else {
                header("location: ../../index.php");
            }
            ?>
        </div>
    <?php

    } else {
        header("Location: ../../index.php");
    }
    ?>
</body>

</html>