<?php
    require("../connectionBdd.php");

    try {
     
        $foreign_key_checks = "SET foreign_key_checks=0";
        $sql_delete_periode = "delete from periodefiscale";
        $sql_delete_ligues = "delete from adherant";
        $sql_delete_notefrais = "delete from notefrais";
        $sql_delete_lignefrais = "delete from lignefrais";


        $sth = $dbh->prepare($foreign_key_checks);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_periode);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_ligues);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_notefrais);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_lignefrais);
        $sth->execute();


        $foreign_key_checks = "SET foreign_key_checks=1";

        $sth = $dbh->prepare($foreign_key_checks);
        $sth->execute();
        
    } catch(Exception $e) {
        echo "<p>" .$e->getMessage(). "</p>";
    }

    try {

    $test_periode ='INSERT into periodefiscale (id_fisc, annee_fisc, isactive_fisc, montant_fisc) VALUES (1 ,2022, 1, 1)';

    $test_adherant ='INSERT into adherant (id_adherant, adresse, cp, id_club, id_util, num_licence, ville) values (1 ,"chez moi", 31000, 1, 3, 11111, "Toulouse")'; 

    $test_notefrais ='INSERT INTO notefrais (id_nfrais, date_ordre, id_adherant, id_fisc, isvalid, num_ordre, tot_nfrais) VALUES (1 ,"2022/02/02", 1, 1, 0, 1, 1)';

    $test_lignefrais ='INSERT INTO lignefrais(id_lfrais, date_deplace, id_motif, lib_deplace, nb_km, frais_peage, frais_repas, frais_heber, id_nFrais) VALUES (1 , "2022/02/02" , 2 , "deplacement", 1, 1, 1, 1,1)';

    
    $sth = $dbh->prepare($test_periode);
    $sth->execute();
    $sth = $dbh->prepare($test_adherant);
    $sth->execute();
    $sth = $dbh->prepare($test_notefrais);
    $sth->execute();
    $sth = $dbh->prepare($test_lignefrais);
    $sth->execute();

    

    } catch(Exception $e) {
    echo "<p>" .$e->getMessage(). "</p>";
    }

?>