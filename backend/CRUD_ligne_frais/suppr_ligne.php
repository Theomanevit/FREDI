<?php

session_start();

$date_deplace = isset($_POST['date_deplace']) ? $_POST['date_deplace'] : '';
$id_motif = isset($_POST['id_motif']) ? $_POST['id_motif'] : '';
$lib_deplace = isset($_POST['lib_deplace']) ? $_POST['lib_deplace'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$frais_peage = isset($_POST['frais_peage']) ? $_POST['frais_peage'] : '';
$frais_repas = isset($_POST['frais_repas']) ? $_POST['frais_repas'] : '';
$frais_heber = isset($_POST['frais_heber']) ? $_POST['frais_heber'] : '';
$submit = isset($_POST['submit']);

require('backend/connectionBdd.php');

