<?php

foreach ($datos as $productos) {  
    foreach ($productos as $producto) {   
        foreach ($producto as $informacion) {
            echo "Nombre: ".$informacion['Producto']."<br>";
            echo "ID: ".$informacion['ID']."<br>";
            echo "Marca: ".$informacion['Marca']."<br>";
            echo "Tamaño: ".$informacion['Tamaño']."<br>";
            echo "<hr>";
        }         
    }             
} 
  
  
		
?>