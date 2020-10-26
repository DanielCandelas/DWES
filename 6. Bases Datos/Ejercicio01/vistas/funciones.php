
<?php

    // existe: Recibe como parámetro un dni y devuelve false si no existe y el resultado del fetch_assoc si existe

    // insertar: Recibe todos los campos como parámetros (uno detrás de otro) e inserta el registro en la tabla de clientes.

    function existe($dni){
        GLOBAL $link;

        $consulta = "SELECT * FROM clientes WHERE dniCliente='$dni'";

        $resultado = $link->query($consulta);

        return  $resultado->fetch_assoc();     
    }



    function insertar($dni, $nombre, $direccion, $email, $pwd, $link){
        
        $consulta = "INSERT INTO clientes VALUES('$dni', '$nombre', '$direccion', '$email', '$pwd')";

        $resultado = $link->query($consulta);

        return $resultado;
    }
 