<?php
/**
 * Ecrit dans une log dans le dossier courant
 *
 * @param string $page le nom de la page PHP
 * @return void
 */
function logToDisk($page)
{
  // Horodatage
  $date = new DateTime('now',new DateTimeZone('Europe/Paris'));
  $laDate = $date->format("Y-m-d H:i:s.u");
  $root = dirname(__FILE__); // Dossier courant
  //$message = $laDate . ";" . $_SERVER['REMOTE_ADDR'] . ";" . $page . ";" . PHP_EOL;
  $message = $laDate .";".get_ip().";".$page.PHP_EOL;
  $filename = $root . DIRECTORY_SEPARATOR . 'log.txt';
  file_put_contents($filename, $message, FILE_APPEND);
}

/**
 * Retourne une adresse IP
 *
 * @return void
 */
function get_ip()
{
  $ip = $_SERVER['HTTP_CLIENT_IP']
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED']
    ?? $_SERVER['HTTP_X_FORWARDED_FOR']
    ?? $_SERVER['HTTP_FORWARDED']
    ?? $_SERVER['HTTP_FORWARDED_FOR']
    ?? $_SERVER['REMOTE_ADDR']
    ?? '0.0.0.0';
  return $ip;
}