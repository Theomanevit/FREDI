<?php
    session_start();
    require("backend/connectionBdd.php");
    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['mdp_user']) ? $_POST['mdp_user'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $ligue = isset($_POST['ligue']) ? $_POST['ligue'] : '';
    $submit = isset($_POST['submit']) ? $_POST['submit'] : '';

    if($submit) {
        $sql ="insert into utilisateur (pseudo_utilisateur, mdp_utilisateur, mail_utilisateur, idType, idLigue)
         values (:pseudo, :mdp, :mail, 1, :ligue)";
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':pseudo' => $username, ':mdp' => $password, ':mail' => $mail, ':ligue' => $ligue));
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            echo "<p>" .$e->getMessage(). "</p>";
        }
        $_SESSION['username'] = $username;
        header("location : index.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Inscription</title>
</head>
<body>
    <?php
        require("header.php");
    ?>
    <h1 class="title">Inscription</h1>
    <?php
        print $username;
        print $password;
        print $mail;
        print $ligue;
        print $submit;
        if(isset($_SESSION['username'])) {
            echo '<p>Vous êtes connecté ' .$_SESSION['username']. '<.p>';
            echo '<p>Accéder à la page <a href="index.php"Page d\'Accueil</a></p>';
        } else {
    ?>
    <form action="register.php">
        <div class="field">
            <label class="label" for="pseudo">Pseudo</label>
            <div class="control">
                <input class="input" type="text" id='pseudo' name='username' placeholder="Entrer votre identifiant" required>
            </div>
        </div>
        <div>
            <label class="label" for="mdp">Mot de passe</label>
            <div class="control">
                <input class="input" type="password" id='mdp' name='mdp_user' placeholder="Entrer un mot de passe" required>
            </div>
        </div>
        <div>
            <label class="label" for="confirm_mdp">Confirmer mot de passe</label>
            <div class="control">
                <input class="input" type="password" placeholder="Confirmer votre mot de passe" required>
            </div>
        </div>
        <div>
            <label class="label" for="mail">Mail</label>
            <div class="control">
                <input class="input" type="email" id='email' name="mail" placeholder="Entrer votre mail" required>
            </div>
        </div>
        <div>
            <label class="label" for="ligue-select">Ligue</label>
            <div class="select">
                <select name="ligue" id="ligue-select" required>
                    <option value="">Choisissez une ligue</option>
                    <option value="athlétisme">Athlétisme</option>
                    <option value="football">Football</option>
                    <option value="escrime">Escrime</option>
                    <option value="rugby">Rugby</option>
                    <option value="volley">Volley</option>
                </select>
            </div>
        </div>
        <div>
            <a href="">Condition générale d'utilisation
                <input type="checkbox" name="CGU" id="CGU_agree" required>
            </a>
            <div style="text-align: right; margin-right : 5%;">
                <input type="submit" name="submit" value="Inscription">
            </div>
        </div>
    </form>
    <?php } ?>
</body>
</html>