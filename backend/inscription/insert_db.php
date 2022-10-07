<?php
    require('backend/functions/check_functions.php');

    $pseudo = isset($_POST['pseudo_util']) ? $_POST['pseudo_util'] : '';
    $first_name = isset($_POST['prenom_util']) ? $_POST['prenom_util'] : '';
    $last_name = isset($_POST['nom_util']) ? $_POST['nom_util'] : '';
    $mail = isset($_POST['mail_util']) ? $_POST['mail_util'] : '';
    $password = isset($_POST['mdp_util']) ? $_POST['mdp_util'] : '';
    $club = isset($_POST['club']) ? $_POST['club'] : '';
    $licence = isset($_POST['num_licence']) ? $_POST['num_licence'] : '';
    $num_rue = isset($_POST['num_rue']) ? $_POST['num_rue'] : '';
    $cp = isset($_POST['cp']) ? $_POST['cp'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $cgu = isset($_POST['cgu']) ? $_POST['cgu'] : '';
    $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
    $options = array('cost' => 11);
    $hash = password_hash($password, PASSWORD_BCRYPT, $options) ;

    if($submit) {
        if (is_empty($password)) {
            $messages = "le mot de passe est obligatoire";
        }
        // au minimum 4 caractères
        if (!min_length($password, 4)) {
        $messages = "le mot de passe doit faire au moins 4 car.";
        }
        // au maximum 12 caractères
        if (!max_length($password, 12)) {
        $messages = "le mot de passe doit faire au plus 12 car.";
        }
    
        // contient au moins un chiffre
        if (!contains_num($password)) {
        $messages = "le mot de passe doit contenir au moins un chiffre";
        }
    
        // contient au moins moins une minuscule
        if (!contains_lowercase($password)) {
        $messages = "le mot de passe doit contenir au moins une minuscule";
        }
    
        // contient au moins moins une majuscule
        if (!contains_uppercase($password)) {
        $messages = "le mot de passe doit contenir au moins une majuscule";
        }
    
        // contient au moins moins un caractère spécial
        if (!contains_special($password)) {
        $messages = "le mot de passe doit contenir au moins un caractère spécial";
        }
        
        if(!isset($messages)) {
            $sql_insert_utilisateur = "insert into utilisateur (pseudo_util, mdp_util, nom_util, prenom_util, mail_util, iscontrol, isadmin) 
            values(:pseudo, :mdp, :nom_util, :prenom_util, :mail, 0, 0)";
            $sql_get_id_util = "select id_util from utilisateur where pseudo_util = :pseudo";
            $sql_insert_adherant = "insert into adherant(num_licence, adresse, ville, cp, id_club, id_util)
            values(:num_licence, :adresse, :ville, :cp, :id_club, :id_util)";
            try {
                //First request insertion data base
                $sth = $dbh->prepare($sql_insert_utilisateur);
                $sth->execute(array(':pseudo' => $pseudo, ':mdp' => $hash, ':nom_util' => $last_name, ':prenom_util' => $first_name, ':mail' => $mail));
                // Get id_util for second request insertion
                $sth = $dbh->prepare($sql_get_id_util);
                $sth->execute(array(':pseudo' => $pseudo));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                $id_util = isset($row['id_util']) ? $row['id_util'] : 1;
                //Second request insertion data base
                $sth = $dbh->prepare($sql_insert_adherant);
                $sth->execute(array(':num_licence' => $licence, ':adresse' => $num_rue, ':ville' => $ville, ':cp' => $cp, ':id_club' => $club, 'id_util' => $id_util));
            } catch(Exception $e) {
                echo "<p>" .$e->getMessage(). "</p>";
            }
            //header("Location: index.php");
        }
    }
?>