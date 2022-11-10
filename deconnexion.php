<?php
session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déconnexion</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
    logToDisk($filename);
    ?>
    <?php
    if (isset($_SESSION['id_util'])) {
        $id_uti = $_SESSION['id_util'];
        session_unset();
        session_destroy();
        setcookie(session_name(), '', -1, '/');
        include('header.php');
        echo '<h1 class="centre">déconecté</h1>';
    }
    ?>
</body>

</html>