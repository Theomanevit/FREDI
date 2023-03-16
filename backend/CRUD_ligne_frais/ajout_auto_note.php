<?php
    if(!isset($id_nfrais)) {
        $id_util = $_SESSION['id_util'];

        try {
            $sql_get_adherant = "SELECT id_adherant from adherant where id_util = ".$id_util;
            $sth = $dbh->prepare($sql_get_adherant);
            $sth->execute();
            $row_adherant = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        try {
            $sql_get_fisc = "SELECT id_fisc from periodefiscale where isactive_fisc = 1";
            $sth = $dbh->prepare($sql_get_fisc);
            $sth->execute();
            $row_fisc = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        try {
            $date = date('y-m-d');
            $sql_insert_note = "INSERT INTO notefrais(isvalid, tot_nfrais, date_ordre, num_ordre, id_adherant, id_fisc)
            VALUES(0, 0, ':date', 0, :id_adherant, :id_fisc)";
            $params = array(
                ":date" => $date,
                ":id_adherant" => $row_adherant["id_adherant"],
                ":id_fisc" => $row_fisc["id_fisc"],
            );
            $sth = $dbh->prepare($sql_insert_note);
            $sth->execute($params);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        try {
            $sql_get_id_nfrais = "SELECT id_nfrais from notefrais as nf, periodefiscale as pf where nf.id_fisc = pf.id_fisc and id_adherant = :id_adherant and isactive_fisc = 1";
            $params = array(
                ":id_adherant" => $row_adherant["id_adherant"]
            );
            $sth = $dbh->prepare($sql_get_id_nfrais);
            $sth->execute($params);
            $row_id_nfrais = $sth->fetch(PDO::FETCH_ASSOC);
            $id_nfrais = $row_id_nfrais["id_nfrais"];
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
    }
?>