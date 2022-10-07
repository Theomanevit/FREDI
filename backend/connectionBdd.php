<?php
    $dsn = "mysql:host=localhost;dbname=fredi21";
    $user = "root";
    $password = "";

    try
    {
        $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        die('Erreur lors de la requête SQL : ' . $e->getMessage());
    }
?>