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

$dsn = 'mysql:host=localhost;dbname=fredi21';
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
        $sql = "select * from utilisateur where mail_util = :mail_util";
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
        $file = fopen("files/new_password.txt", "w") or exit("<p>Impossible d'ouvrir le fichier</p>");
        fwrite($file, $NEW_mdp_util);
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
    <link rel="stylesheet" href="css/connexion.css">
    <title>demande_mdp</title>
</head>

<body>
    <?php include('header.php') ?>
    <h1 class="centre">demande d'un mot de passe</h1>
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="field padding-bottom--24">
                        <label>Adresse mail</label>
                        <input type="text" name="mail_util" id="mail_util">
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Validée" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>