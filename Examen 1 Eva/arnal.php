<?php


    function dca($link, $tabla, $clave, $campo){

        $string = "<select name='".$clave."'>";

        $consulta = "SELECT ".$campo." FROM ".$tabla;        
        $resultado = $link->query($consulta);

        while ($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $value) {
                $string .= "<option>".$value."</option>";
            }          
        }       
        $string .= "</select>";

        

        return $string;
    }