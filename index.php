<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>FREDI accueil</title>
</head>

<body>
    <?php include('header.php') ?>
    <h1 class="centre">FREDI : Le site de l'avenir du sport</h1>
    <?php 
        if (isset($_SESSION['isadmin'])) {
        	echo '<div class="field padding-bottom--24">';
                echo '<label>Base de données : </label>';
                echo '<button><a href="backend/compte/parsecsv.php">Charger</a></button>';
            echo '</div>';

        } 
    ?>
</body>

</html>