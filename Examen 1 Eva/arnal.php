<?php


    function dca($link, $tabla, $clave, $campo){

        $string = "<select>";

        $consulta = "SELECT ".$campo." FROM ".$tabla." where ".$clave."='".$clave."'";        
        $resultado = $link->query($consulta);

        while ($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $value) {
                $string .= "<option>".$value."</option>";
            }          
        }       
        $string .= "</select>";

        return $string;
    }