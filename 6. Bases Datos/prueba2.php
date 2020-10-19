<?php

/* Mostar todos los productos y todos sus campos con fore*/

    $link = new mysqli('localhost', 'root', '', 'virtualmarket');

    if ($link->connect_errno) {
        echo "ERROR en la conexion ".$link->connect_error;
    } else {

        $link->set_charset('UTF-8');


        $consulta = "SELECT * FROM productos";

        $resultado = $link->query($consulta);

        while ($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $key => $value) {
                echo "$key: $value <br>";
            } 
            echo "<br>";           
        }
    }

    $resultado->free();
    $link->close();

?>