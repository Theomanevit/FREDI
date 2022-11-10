<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];

require('backend/connectionBdd.php');

