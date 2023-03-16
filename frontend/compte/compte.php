<?php
session_start();


$dsn = 'mysql:host=localhost;dbname=fredi21';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
}

$id_util = $_SESSION["id_util"];

try {
    $sql = "SELECT pseudo_util,nom_util,prenom_util,mail_util,num_licence,adresse,ville,cp,lib_club FROM adherant,utilisateur,clubs WHERE adherant.id_util=utilisateur.id_util AND adherant.id_club=clubs.id_club AND utilisateur.id_util=:id_util";
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':id_util' => $id_util
    ));
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("<p>Erreur lors de la requête SQL : " . $ex->getMessage() . "</p>");
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/connexion.css">
    <link rel="stylesheet" href="../../css/tableau.css">
    <title>Mon compte</title>
</head>

<body>
    <?php
    if (isset($_SESSION['id_util'])) {
    ?>
        <?php include('../../header.php') ?>
        <h1>Compte</h1>
        <div class="formbg-outer">
            <div class="formbg">
                <div class="formbg-inner padding-horizontal--48">
                <table>
                    <?php
                    foreach ($rows as $row) {
                    ?>
                        <tr>
                            <th>Pseudo</th>
                            <td><p><?php echo $row['pseudo_util']; ?></p></td>
                        </tr>
                        <tr>
                        <th>Nom</th>
                            <td><p><?php echo $row['nom_util']; ?></p></td>
                        </tr>
                        <th>Prenom</th>
                            <td><p><?php echo $row['prenom_util']; ?></p></td>
                        </tr>
                        <th>Mail</th>
                            <td><p><?php echo $row['mail_util']; ?></p></td>
                        </tr>
                        <th>Numéro de licence</th>
                            <td><p><?php echo $row['num_licence']; ?></p></td>
                        </tr>
                        <th>Adresse</th>
                            <td><p><?php echo $row['adresse']; ?></p></td>
                        </tr>
                        <th>Ville</th>
                            <td><p><?php echo $row['ville']; ?></p></td>
                        </tr>
                        <th>Code postal</th>
                            <td><p><?php echo $row['cp']; ?></p></td>
                        </tr>
                        <th>Club</th>
                            <td><p><?php echo $row['lib_club']; ?></p></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    <?php

    } else {
        header("Location: ../../index.php");
    }
    ?>
</body>

</html>