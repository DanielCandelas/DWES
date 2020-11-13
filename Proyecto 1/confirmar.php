<?php

    session_start();
    require "vistas/inicio.html";
    require "modelo.php";
    $base = new Bd(); 

    $mensaje = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><p>El siguiente pedido a sido registrado</p> <br>";
    require "vistas/mensaje.php";






    
    
    //$base->link->close();
    session_destroy();
    require "vistas/fin.html";

    /*
    if (isset($_SESSION['nombre'])) {   

    }else{    
        $mensaje = "Es necesario estar registrado<br>";
        $mensaje .= "<a href='validar.php'> Volver </a>";
        require "vistas/mensaje.php";
    }
    */