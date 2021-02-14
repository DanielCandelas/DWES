<?php

foreach ($datos as $key => $value) {    
    if ($key == 'Datos'){
        foreach ($value as $key => $value) { 
            if ($key == 'Ítems') {
                foreach ($value as $informacion) {
                    $dato = "<br>";
                    $dato.= "Nombre: ".$informacion['Producto']."<br>";
                    $dato.= "ID: ".$informacion['ID']."<br>";
                    $dato.= "Marca: ".$informacion['Marca']."<br>";
                    $dato.= "Tamaño: ".$informacion['Tamaño']."<br>";
                    $dato.= "<hr>";
                    require "vistas/mensaje.php";
                }  
            }   
        } 
    }            
}  
  
		
?>