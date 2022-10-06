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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Inscription</title>
</head>
<body>
    <?php
        require("header.php");
    ?>
    <h1 class="title">Inscription</h1>
    <?php
        if(isset($_SESSION['id_util'])) {
            echo '<p>Vous êtes connecté ' .$_SESSION['pseudo_util']. '<.p>';
            echo '<p>Accéder à la page <a href="index.php"Page d\'Accueil</a></p>';
        } else {
    ?>
    <form action="inscription.php" method="post">
        <div class="field">
            <label class="label" for="pseudo">Pseudo</label>
            <div class="control">
                <input class="input" type="text" id='pseudo-util' name='pseudo_util' placeholder="Entrer votre identifiant" required>
            </div>
        </div>

        <div>
            <?php if(isset($messages)) { echo "<p>".$messages."</p>"; } ?>
            <label class="label" for="mdp">Mot de passe</label>
            <div class="control">
                <input class="input" type="password" id='mdp_util' name='mdp_util' placeholder="Entrer un mot de passe" required>
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
                <input class="input" type="email" id='mail_util' name="mail_util" placeholder="Entrer votre mail" required>
            </div>
        </div>


        <!-- compléter correctement le menu club -->
        <div>
            <label class="label" for="club-select">Club</label>
            <div class="select">
                <select name="club" id="club-select" required>
                    <option value="">Choisissez un club</option>
                    <option value="1">Athlétisme</option>
                    <option value="2">Football</option>
                    <option value="3">Escrime</option>
                    <option value="4">Rugby</option>
                    <option value="5">Volley</option>
                </select>
            </div>
        </div>

        <div>
            <label class="label" for="num_licence">Numéro de licence</label>
            <div class="control">
                <input class="input" type="text" id='num_licence' name="num_licence" placeholder="Entrer votre numéro de licence" required>
            </div>
        </div>

        <div>
            <label class="label" for="num_rue">Numéro et rue</label>
            <div class="control">
                <input class="input" type="text" id='adresse' name="num_rue" placeholder="Entrer votre numéro de rue et la rue" required>
            </div>
        </div>

        <div>
            <label class="label" for="cp">Code postal</label>
            <div class="control">
                <input class="input" type="text" id='cp' name="cp" placeholder="Entrer votre code postal" required>
            </div>
        </div>

        <div>
            <label class="label" for="vile">Ville</label>
            <div class="control">
                <input class="input" type="text" id='ville' name="ville" placeholder="Entrer votre ville" required>
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