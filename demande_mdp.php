<?php
function getrandomstring($length)
{

    global $template;
    settype($template, "string");

    $template = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%?!";
    /* this line can include numbers or not */

    settype($length, "integer");
    settype($rndstring, "string");
    settype($a, "integer");
    settype($b, "integer");

    for ($a = 0; $a <= $length; $a++) {
        $b = rand(0, strlen($template) - 1);
        $rndstring .= $template[$b];
    }

    return $rndstring;
}


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


$mail_util = isset($_POST['mail_util']) ? $_POST['mail_util'] : NULL;
$submit = isset($_POST['submit']);
$message = "";
if ($submit) {
    try {
        $sql = "select id_util from utilisateur where mail_util = :mail_util";
        $params = array(
            "mail_util" => $mail_util,
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    foreach ($rows as $row) {
        $id_util = $row["id_util"];
    }

    if (isset($id_util)) {
        $length = 8;
        $NEW_mdp_util = getrandomstring($length);
        $options = array('cost' => 11);
        $hash = password_hash($NEW_mdp_util, PASSWORD_BCRYPT, $options);
        try {
            $sql = "update utilisateur set mdp_util= :mdp_util where id_util= :id_util";
            $params = array(
                "mdp_util" => $hash,
                "id_util" => $id_util
            );
            $sth = $dbh->prepare($sql);
            $sth->execute($params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
        }
        header('location: index.php');
    }
} 
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demande_mdp</title>
</head>

<body>
    <h2>demande d'un mot de passe</h2>
    </p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Adresse mail<br /><input type="text" name="mail_util" id="mail_util"></p>
        <p><input type="submit" name="submit" value="OK" />
        <button>
            <a href="index.php">retour</a>
        </button>
        </p>
    </form>
</body>

</html>