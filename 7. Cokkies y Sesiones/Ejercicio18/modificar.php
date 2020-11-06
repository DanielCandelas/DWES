<?php
    session_start();
    
    if (isset($_SESSION['nombre'])){
        require "modelo.php";
        if (isset($_POST['enviarModificar'])) {
    
            $link = new Bd;
            $cli = new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['pwd']);
    
                if($cli->modificar($link->link)){
                    $mensaje = "El cliente se ha modificado correctamente";
                    $mensaje .= "<a href='index.php'>Volver</a>";
                    require "vistas/mensaje.php";
                } else {
                    $mensaje = "ERROR AL MODIFICAR";
                    $mensaje .= "<a href='index.php'>Volver</a>";
                    require "vistas/mensaje.php";
                }
        }else{
    
            $link = new Bd;
            $cli = new Cliente($_GET['dni'],'','','','');
            $datos = $cli->buscar($link->link);
            require "vistas/formularioModificar.php";
            $link->link->close();
        }

    }else {
        $mensaje = "Es necesario estar registrado<br>";
        $mensaje .= "<a href='index.php'> Volver </a>";
        require "vistas/mensaje.php";
    }

    include "vistas/fin.html";

    

    