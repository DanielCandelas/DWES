<?php

    require "vistas/inicio.html";
    require "modelo.php";

    if (isset($_POST['enviar'])) {

        $base = new Bd();
        $cli = new Cliente($_POST['dniCliente'], $_POST['nombre'], $_POST['direccion'], $_POST['mail'], $_POST['pwd']);

        if ($cli->buscar($base->link)) {
            $mensaje = "El usuario ya existe";
            $mensaje .= "<a href='controlador.php'>Volver</a>";
            require "vistas/mensaje.php";
        } else {
            if ($cli->insertar($base->link)) {
                $mensaje = "Usuario Introducido correctamente";
                $mensaje .= "<a href='controlador.php'>Volver</a>";
                require "vistas/mensaje.php";
            }                     
        }       

        $base->link->close(); 

    } else {
        require "vistas/formulario.php";
    }

    require "vistas/fin.html";

?>