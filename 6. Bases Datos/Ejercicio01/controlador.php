
<?php

    require "vistas/inicio.html";
    require "vistas/funciones.php";

    if (isset($_POST['enviar'])) {

        $dni = $_POST['dniCliente'];
        $nombre = $_POST['dniCliente'];
        $direccion = $_POST['direccion'];
        $email = $_POST['mail'];
        $pws = $_POST['pws'];

        $link = new mysqli('localhost', 'root', '', 'virtualmarket');

        if ($link->connect_errno) {

            $mensaje = "Error al conectar con MYSQL ".$link->connect_error;
            require "vistas/mensaje.php";
        } else {

            $link->set_charset('UTF-8');

            if (existe($dni)) {
                $mensaje = "El usuario ya existe";
            } else {
                insertar($dni, $nombre, $direccion, $email, $pws, $link);
                if (existe($dni)) {
                    $mensaje = "Usuario Introducido correctamente";
                    
                } else {
                    $mensaje = "El usuario NO se ha introducido correctamente";
                }
            }
            
            require "vistas/mensaje.php";
        }
        $link->close();

    } else {
        require "vistas/formulario.php";
    }

    require "vistas/fin.html";

?>