<?php

    session_start();

    require "vistas/inicio.html";
    require "modelo.php";

    $carro = new Carrito('', '', '', '', $_SESSION['total']);
    $mensaje = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><br>";
    require "vistas/mensaje.php";

    if (isset($_POST['comprar'])){   //Si hemos enviado el formulario, venimos desde detalle.php   

        $prod = new Carrito($_POST['id'], $_POST['nombre_producto'], $_POST['precio'], $_POST['cantidad'], $_SESSION['total']);

        $prod->anadirProducto(); 
        $carro->dibujarCarro();
    } else {  //Si NO hemos enviado el formulario, venimos desde principal.php   
        
        $carro->dibujarCarro();
    }   

    require "vistas/fin.html";