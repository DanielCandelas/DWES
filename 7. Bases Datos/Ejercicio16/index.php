<?php

    require "vistas/inicio.html";
    require "modelo.php";

    $base = new Bd();
    $datos = Cliente::formar_Tabla($base->link);

    $mensaje = $datos;
    require "vistas/mensaje.php";    

    require "vistas/fin.html";

?>