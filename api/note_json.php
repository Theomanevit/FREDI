<?php
    require('../init.php');
    require('../backend/connectionBdd.php');

    $email = isset($_GET['email']) ? $_GET['email'] : null;
    $password = isset($_GET['password']) ? $_GET['password'] : null;

    try {
        $sql = "select id_util, mail_util, mdp_util, nom_util, prenom_util, iscontrol, isadmin from utilisateur where mail_util = :mail_util";
        $params = array(
            "mail_util" => $email
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $row_util = $sth->fetch(PDO::FETCH_ASSOC);
        $count_row = $sth->rowCount();
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    
    $hash = isset($row_util['mdp_util']) ? $row_util['mdp_util'] : '';

    if(password_verify($password, $hash)) {
        try {
            $sql = "select annee_fisc as date, montant_fisc as forfait, isactive_fisc as statut from periodefiscale where isactive_fisc = 1";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $row_fisc = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
        }

        try {
            $sql = "select id_nfrais, id_adherant from notefrais as nf, periodefiscale as pf where nf.id_fisc = pf.id_fisc and isvalid = 0 and isactive_fisc = 1";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $rows_nfrais = $sth->fetchAll(PDO::FETCH_ASSOC);
            $count_row_nfrais = $sth->rowCount();
        } catch (PDOException $e) {
            die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
        }

        $utilisateur = array(
            "email" => $row_util['mail_util'],
            "nom" => $row_util['nom_util'],
            "prenom" => $row_util['prenom_util'],
            "estControleur" => $row_util['iscontrol'],
            "estAdmin" => $row_util['isadmin']
        );

        $periode = array(
            "date" => $row_fisc['date'],
            "forfait" => $row_fisc['forfait'],
            "statut" => $row_fisc['statut']
        );

        
        if($count_row_nfrais > 0 && $row_util['isadmin'] == 0) {
            $lignes = array();

            foreach($rows_nfrais as $row_nfrais) {
                if($row_nfrais['id_adherant'] == $row_util['id_util'] || $row_util['iscontrol'] == 1) {
                    try {
                        $sql = "select id_lfrais as id, date_deplace as date, lib_deplace as libelle, frais_peage as cout_peage, frais_repas as cout_repas, 
                        frais_heber as cout_hebergement, nb_km, total_lfrais as total_ligne, lib_motif as motif 
                        from lignefrais as lf, motifdeplacement as md where lf.id_motif = md.id_motif and id_nfrais = :id_nfrais";
                        $params = array(
                            "id_nfrais" => $row_nfrais["id_nfrais"]
                        );
                        $sth = $dbh->prepare($sql);
                        $sth->execute($params);
                        $rows_lignes = $sth->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                    }
                    
                    foreach($rows_lignes as $row) {
                        $ligne = array(
                            "id" => $row['id'],
                            "date" => $row['date'],
                            "libelle" => $row['libelle'],
                            "cout_peage" => $row['cout_peage'],
                            "cout_repas" => $row['cout_repas'],
                            "cout_hebergement" => $row['cout_hebergement'],
                            "nb_km" => $row['nb_km'],
                            "cout_km" => ($row['nb_km'] * $row_fisc['forfait']),
                            "total_ligne" => $row['total_ligne'],
                            "motif" => $row['motif']
                        );
                        $lignes[] = $ligne;
                    }
                }
            }

            $frediJSON = array(
                ":message" => "OK : note générée",
                "utilisateur" => $utilisateur,
                "periode" => $periode,
                "lignes" => $lignes
            );
        } else {
            $frediJSON = array(
                ":message" => "KO : pas de note",
                "utilisateur" => $utilisateur,
                "periode" => $periode
            );
        }
  
    } else {
        if(isset($email) && isset($password)) {
        $frediJSON = array(
            ":message" => "KO : erreur utilisateur inconnu"
        );
        } else {
            $frediJSON = array(
                ":message" => "KO : erreur email et/ou mot de passe non fournis(s)"
            );
        }
    }
    $JSON = json_encode($frediJSON, JSON_PRETTY_PRINT);
    header("Content-type: application/json; charset=utf-8");
    echo $JSON;
    
    
?>