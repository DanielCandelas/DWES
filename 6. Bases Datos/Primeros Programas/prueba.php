<?php

/* Mostar todos los clientes y todos sus campos con fore*/

    $link = new mysqli('localhost', 'root', '', 'virtualmarket');

    if ($link->connect_errno) {
        echo "Error al conectarse ".$link->connect_error; 
    } else {

        $link->set_charset('UTF-8');

        $consulta = "SELECT * FROM clientes";

        $resultado = $link->query($consulta);

        $aux = true;

        echo "<table border='1'";

        while($fila=$resultado->fetch_assoc()){
            $linea1 = "";
            $linea2 = "";   
            $linea1 = "<tr>";
            $linea2 = "<tr>";         
            foreach ($fila as $key => $value) {                
                if ($aux) {
                    $linea1 .= "<th> $key </th>";
                }                
                $linea2 .= "<td> $value </td> ";
            }            
            $aux = false;
            $linea1 .= "</tr>";
            $linea2 .= "</tr>";
            echo $linea1;
            echo $linea2;
        }
        echo "</table>";

        $resultado->free();
        $link->close();
        
    }

?>