
<?php
    session_start();

    if (isset($_SESSION['nombre'])){
        require "modelo.php";

        $base = new Bd();
        $consulta = "DELETE FROM clientes WHERE dniCliente='".$_GET['dni']."'";
        $base->link->query($consulta);

        $mensaje = "Usuario borrado con exito <br><br>";
        $mensaje .= "<a href='index.php'>Volver</a>";
        require "vistas/mensaje.php";

    }else {
        $mensaje = "Es necesario estar registrado<br>";
        $mensaje .= "<a href='index.php'> Volver </a>";
        require "vistas/mensaje.php";
    }

    require "vistas/fin.html";