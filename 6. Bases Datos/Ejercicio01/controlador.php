
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
            echo "Error al conectar con MYSQL ".$link->connect_error;
        } else {

            $link->set_charset('UTF-8');

            if (existe($dni, $link)) {
               echo "El usuario ya existe";
            } else {
                insertar($dni, );
            }

        }

        $link->close();


    } else {
        require "vistas/formulario.php";
    }

    require "vistas/fin.html";

?>