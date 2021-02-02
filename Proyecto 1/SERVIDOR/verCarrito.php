<?php

    session_start();

    require "vistas/inicio.html";
    require "modelo.php";   

    if (isset($_SESSION['nombre'])) {
        $carro = new Carrito('', '', '', '', $_SESSION['total']);

        $mensaje = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><br>";
        require "vistas/mensaje.php";

        if (isset($_POST['comprar'])){   //Si hemos enviado el formulario, venimos desde detalle.php 
            
            $carro->idProducto = $_POST['idProducto'];
            $carro->nombre_producto =  $_POST['nombre_producto'];
            $carro->precio = $_POST['precio'];
            $carro->cantidad = $_POST['cantidad'];

            $carro->anadirProducto(); 
            $carro->dibujarCarro();
        } else {  //Si NO hemos enviado el formulario, venimos desde principal.php   
            
            $carro->dibujarCarro();
        }

    }else{    
        $mensaje = "Es necesario validarse<br>";
        $mensaje .= "<a href='validar.php'> Validarse </a>";
        require "vistas/mensaje.php";
    }       

    require "vistas/fin.html";