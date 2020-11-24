<?php

    session_start();

    require "vistas/inicio2.html";
    require "modelo.php";
    $base = new Bd();

    if (!isset($_SESSION['nombre'])){

        if (isset($_POST['enviarPass'])){            
            $cli= new Cliente($_POST['dni'],'','','',$_POST['pass']);

            if($nom=$cli->autenticar($base->link)){
                $_SESSION['nombre'] = $nom['nombre'];
            } else {
                $mensaje = "el usuario o la contraseña es incorrecta<br>";
                $mensaje .= "<a href='index.php'> Volver </a>";
                require "vistas/mensaje.php";
            }

        } else require "vistas/validacion.php";

    }

    if (isset($_SESSION['nombre'])){
        require "vistas/inicio.html";
        $mensaje = "Bienvenido ".$_SESSION['nombre'];
        require "vistas/mensaje.php";

        $datos = Cliente::formar_Tabla($base->link);
        $mensaje = $datos;
        require "vistas/mensaje.php"; 
    }
    
    $base->link->close();
    session_destroy();
    require "vistas/fin.html";


?>