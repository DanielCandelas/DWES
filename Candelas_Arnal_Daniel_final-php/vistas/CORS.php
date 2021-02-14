<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD']; //obrtengo el metodo

if ($method == 'OPTIONS') {  // para metodo options, solo devuelvo una cabecera de ok. OJO, sin esto los servicios Angular dan un error
  header("HTTP/1.1 200 OK");
  exit();
}