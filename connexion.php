<?php

session_start();

$dsn = 'mysql:host=localhost;dbname=fredi';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
}


$pseudo_util = isset($_POST['pseudo_util']) ? $_POST['pseudo_util'] : NULL;
$mdp_util = isset($_POST['mdp_util']) ? $_POST['mdp_util'] : NULL;
$submit = isset($_POST['submit']);
$message = "";


if ($submit) {
    try {
        $sql = "select mdp_util from utilisateur where pseudo_util = :pseudo_util";
        $params = array(
            "pseudo_util" => $pseudo_util,
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    foreach ($rows as $row) {
        $hash = $row["mdp_util"];
    }
    if (password_verify($mdp_util, $hash)) {
        try {
            $sql = "select id_util from utilisateur where pseudo_util = :pseudo_util and mdp_util = :mdp_util";
            $params = array(
                "pseudo_util" => $pseudo_util,
                "mdp_util" => $hash,
            );
            $sth = $dbh->prepare($sql);
            $sth->execute($params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
        }
        if ($sth->rowCount()) {
            $_SESSION["id_util"] = $id_util;
            $_SESSION["mdp_util"] = $mdp_util;
            foreach ($rows as $row) {
                $id_util = $row["id_util"];
            }
            header('location: index.php');
        }
    } else {
        echo 'mot de passe invalide';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>

<body>
    <h2>Connexion</h2>
    </p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Pseudo<br /><input type="text" name="pseudo_util" id="pseudo_util" value="<?= $pseudo_util ?>"></p>
        <p>mot de passe<br /><input type="mdp_util" name="mdp_util" id="mdp_util"></p>
        <p><input type="submit" name="submit" value="OK" /></p>
    </form>
</body>

</html>