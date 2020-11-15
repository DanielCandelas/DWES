<?php

    session_start();

    require "vistas/inicio.html";
    require "modelo.php";  

    if (isset($_SESSION['nombre'])) {
        $base = new Bd();
        $datos = Productos::dibujarPrincipal($base->link);
        $mensaje = $datos;
        require "vistas/mensaje.php"; 

    }else{    
        $mensaje = "Es necesario validarse<br>";
        $mensaje .= "<a href='validar.php'> Validarse </a>";
        require "vistas/mensaje.php";
    }
    
    require "vistas/fin.html";

    

