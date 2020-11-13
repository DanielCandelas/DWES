<?php

    session_start();
    require "vistas/inicio.html";
    require "modelo.php";
    $base = new Bd(); 

    $mensaje = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><p>El siguiente pedido a sido registrado</p> <br>";
    require "vistas/mensaje.php";

    $aux = new Pedidos('', '', '', '', '');  //Objeto pedidos auxiliar para calcular el id del nuevo pedido
    $id = $aux->calcularId($base->link);
    $id++;

    $pedidos = new Pedidos($id, $_SESSION['dni'], '', '', '');    

    $pedidos->insertarPedido($base->link);

    for($i = 0; $i < $_SESSION['total']; $i++){ 
        $pedidos->nlinea = $i + 1;
        echo $pedidos->nlinea;
        $idProducto = $_SESSION['id'][$i];
        $cantidad = $_SESSION['cantidad'][$i];   
        $pedidos->insertar($base->link);                            
    }

    //$pedidos->insertarLineasPedido($base->link);
    $pedidos->dibujarCarro();


    $base->link->close();
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