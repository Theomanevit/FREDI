<?php
session_start();

$submit = isset($_POST['submit']);

if ($submit) {
    header("location: deconnexion.php");
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm_déconnexion</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1 class="centre">Voulez-vous vous déconecté ?</h1>
    <form action="confirm_deconnexion.php" method="POST">
        <div class="centre_div">
            <input type="submit" name="submit" value="confirmer">
        </div>
        <div class="centre_div padding">
            <h2>
                <a href="index.php" class="btn">
                    <span>Retour</span>
                </a>
            </h2>
        </div>
    </form>
</body>

</html>