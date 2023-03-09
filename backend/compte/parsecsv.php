<?php
    require("../connectionBdd.php");
    
    $csvFileClubs = "../../files/csv/clubs.csv";
    $csvFileLigues = "../../files/csv/ligues.csv";
    $csvFileMotifs = "../../files/csv/motifs.csv";

    try {
        //Delete data in database clubs, ligues, motifs
        $foreign_key_checks = "SET foreign_key_checks=0";
        $sql_delete_clubs = "delete from clubs";
        $sql_delete_ligues = "delete from ligues";
        $sql_delete_motifs = "delete from motifdeplacement";


        $sth = $dbh->prepare($foreign_key_checks);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_clubs);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_ligues);
        $sth->execute();
        $sth = $dbh->prepare($sql_delete_motifs);
        $sth->execute();


        $foreign_key_checks = "SET foreign_key_checks=1";

        $sth = $dbh->prepare($foreign_key_checks);
        $sth->execute();
        
    } catch(Exception $e) {
        echo "<p>" .$e->getMessage(). "</p>";
    }

    /*
    * Open files and get the content for insertion database
    */

    //Ligues
    if (($handle = fopen($csvFileLigues, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            $sql_insert_ligues = 'insert into ligues values('.$data[0].', "'.$data[1].'")';
            try {
                //Insertion data of file csvFileLigues in database
                $sth = $dbh->prepare($sql_insert_ligues);
                $sth->execute();
            } catch(Exception $e) {
                echo "<p>" .$e->getMessage(). "</p>";
            }
        }
        fclose($handle);
    }
    //Clubs
    if (($handle = fopen($csvFileClubs, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            $sql_insert_clubs = 'insert into clubs values('.$data[0].', "'.$data[1].'", "'.$data[2].'", "'.$data[3].'", "'.$data[4].'", '.$data[5].')';
            try {
                //Insertion data of file csvFileClubs in database
                $sth = $dbh->prepare($sql_insert_clubs);
                $sth->execute();
            } catch(Exception $e) {
                echo "<p>" .$e->getMessage(). "</p>";
            }
        }
        fclose($handle);
    }

    //Motifs
    if (($handle = fopen($csvFileMotifs, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            $sql_insert_motifs = 'insert into motifdeplacement values('.$data[0].', "'.$data[1].'")';
            try {
                //Insertion data of file csvFileMotifs in database
                $sth = $dbh->prepare($sql_insert_motifs);
                $sth->execute();
            } catch(Exception $e) {
                echo "<p>" .$e->getMessage(). "</p>";
            }
        }
        fclose($handle);
    }

    include("donnéestest.php");

    header('location: ../../inscription.php');
?>