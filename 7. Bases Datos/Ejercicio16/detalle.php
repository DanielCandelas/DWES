
<?php


    require "modelo.php";

    $base = new Bd();
    $datos = Cliente::getAll($base->link);
    $linea = "";

    while ($fila = $datos->fetch_assoc()) {
        if ($fila['dniCliente'] == $_GET['dni']) {
            foreach ($fila as $key => $value) {
                $linea .= "$key: $value <br>";
            } 
        }                   
    }

    $mensaje = $linea;
    $mensaje .= "<br><a href='index.php'>Volver</a>";
    
    require "vistas/mensaje.php";

    require "vistas/fin.html";
    
    