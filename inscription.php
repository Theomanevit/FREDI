<?php
session_start();
require("backend/connectionBdd.php");
require("backend/inscription/insert_db.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Inscription</title>
</head>

<body>
    <?php
    require("header.php");
    ?>
    <h1 class="centre">Inscription</h1>
    <?php
    if (isset($_SESSION['id_util'])) {
        header("Location: index.php");
    } else {
    ?>
        <div class="formbg-outer">
            <div class="formbg">
                <div class="formbg-inner padding-horizontal--48">
                    <form action="inscription.php" method="post">
                        <div class="field padding-bottom--24">
                            <label>Chargement la base de données</label>
                            <?php if (isset($_SESSION['id_util']) || true) { ?>
                                <button onClick="parent.location.href='backend/compte/parsecsv.php'" type="button">Recharger la base de données</button>
                            <?php } else {
                                header("location: ../../index.php");
                            } ?>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Pseudo</label>
                            <input type="text" name="pseudo_util" id="pseudo_util" placeholder="Entrer un identifiant" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Prénom</label>
                            <input type="text" name="prenom_util" id="prenom_util" placeholder="Entrer votre prénom" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Nom</label>
                            <input type="text" name="nom_util" id="nom_util" placeholder="Entrer votre nom" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Mot de passe</label>
                            <input type="password" name="mdp_util" id="mdp_util" placeholder="Entrer un mot de passe" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Confirmer mot de passe</label>
                            <input type="password" placeholder="Confirmer mot de passe" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Mail</label>
                            <input type="email" name="mail_util" id="mail_util" placeholder="Entrer votre mail" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Club</label>
                            <select name="club" id="club" required>
                                <option value="">Choisissez un club</option>
                                <option value="1">Athlétisme</option>
                                <option value="2">Football</option>
                                <option value="3">Escrime</option>
                                <option value="4">Rugby</option>
                                <option value="5">Volley</option>
                            </select>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Numéro de licence</label>
                            <input type="text" name="num_licence" id="num_licence" placeholder="Entrer votre numéro de licence" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Numéro et rue</label>
                            <input type="text" name="num_rue" id="num_rue" placeholder="Entrer votre numéro de rue et la rue" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Code postal</label>
                            <input type="text" name="cp" id="cp" placeholder="Entrer votre code postal" required>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Ville</label>
                            <input type="text" name="ville" id="ville" placeholder="Entrer votre ville" required>
                        </div>
                        <div>
                            <p>
                                <a href="condition_generale_utilisation.php" target="_blank">Condition générale d'utilisation</a>
                                <input type="checkbox" name="cgu" id="cgu" required>
                            </p>
                        </div>


                        <div class="field padding-bottom--24">
                            <input type="submit" name="submit" value="Validée" />
                        </div>
                    </form>
                    <div>
                        <?php if (isset($messages)) {
                            echo "<p>" . $messages . "</p>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>