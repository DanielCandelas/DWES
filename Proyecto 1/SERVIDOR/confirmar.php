<?php

    session_start();
    require "vistas/inicio.html";
    require "modelo.php";
    $base = new Bd(); 

    if (isset($_SESSION['nombre'])) {
        $mensaje = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><p>El siguiente pedido a sido registrado</p> <br>";
        require "vistas/mensaje.php";

        $pedidos_lineas = new lineasPedido('', '', '', ''); 
        $pedidos = new Pedidos('', '', '');  //Objeto pedidos auxiliar para calcular el id del nuevo pedido
        $idPedido = $pedidos->calcularId($base->link);
        $idPedido++;

        $pedidos->idPedido = $idPedido;
        $pedidos_lineas->idPedido = $idPedido;
        $pedidos->dniCliente = $_SESSION['dni'];    

        $pedidos->insertarPedido($base->link);

        for($i = 0; $i < $_SESSION['total']; $i++){ 
            $pedidos_lineas->nlinea = $i + 1;
            $pedidos_lineas->idProducto = $_SESSION['idProducto'][$i];
            $pedidos_lineas->cantidad = $_SESSION['cantidad'][$i];
            $pedidos_lineas->insertarLineasPedido($base->link);
        }

        $pedidos->dibujarCarro();

    }else{    
        $mensaje = "Es necesario validarse<br>";
        $mensaje .= "<a href='validar.php'> Validarse </a>";
        require "vistas/mensaje.php";
    }

    $base->link->close();
    session_destroy();
    require "vistas/fin.html";

    
       

    
    