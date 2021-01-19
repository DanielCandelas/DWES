<?php

/*
$a = 4;
$b = 6;
$consulta = "a=$a&b=$b";

$respuesta = file_get_contents("http://localhost/DWES-2021/10.%20Servicios%20Web/API/Prueba/suma.php?$consulta");

echo $respuesta;
*/

$respuesta = json_decode(file_get_contents(""));

foreach ($respuesta as $key => $value) {
    echo $key." - ".$value."<br>";
}
