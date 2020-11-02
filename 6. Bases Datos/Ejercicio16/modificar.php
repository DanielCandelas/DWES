
<?php

    require "modelo.php";

    if (isset($_POST['enviar'])) {
                
        $base = new Bd();

        $consulta = "   UPDATE clientes 
                    SET 
                    WHERE dniCliente='".$_GET['dni']."'";

        $base->link->query($consulta);

        $mensaje = "Usuario actualizado con exito <br><br>";
        $mensaje .= "<a href='index.php'>Volver</a>";
        require "vistas/mensaje.php";
        
    } else {
        require "vistas/formulario.php";
    }

    

    