

<?php

    require "modelo.php";

    if (isset($_POST['enviar'])) {
                
        $base = new Bd();
        $cli = new Cliente($_POST['dniCliente'], $_POST['nombre'], $_POST['direccion'], $_POST['mail'], $_POST['pwd']);

        if ($cli->buscar($base->link)) {    //Comprobar si existe el cliente y si no es asi insertarlo
            $mensaje = "El usuario ya existe";            
            require "vistas/mensaje.php";
            require "vistas/formulario.php";
        } else {
            nuevo($base->link);
            $mensaje = "Usuario introducido con exito <br><br>";
            $mensaje .= "<a href='index.php'>Volver</a>";
            require "vistas/mensaje.php";
        }
    } else {
        require "vistas/formulario.php";
    }
    
    
    function nuevo($link){
            
        $consulta = "INSERT INTO clientes VALUES('".$_POST['dniCliente']."', '".$_POST['nombre']."', '".$_POST['direccion']."', '".$_POST['mail']."', '".$_POST['pwd']."')";

        $link->query($consulta);

        $resultado = "<tr> <td> ".$_POST['dniCliente']." </td> <td>".$_POST['nombre']."</td> </tr>";

        return $resultado;
    }

    require "vistas/fin.html";
    
         
    