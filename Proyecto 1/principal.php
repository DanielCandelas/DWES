<?php

    session_start();

    require "vistas/inicio.html";
    require "modelo.php";  

    $base = new Bd();
    $datos = Productos::dibujarPrincipal($base->link);
    $mensaje = $datos;
    require "vistas/mensaje.php"; 

    

