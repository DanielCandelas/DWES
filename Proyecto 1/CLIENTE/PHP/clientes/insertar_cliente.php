<?php

    require "../../../php/modelo.php";
    $link=new Bd;

    $cli= new Cliente($_POST['nuevo_dni'],$_POST['nuevo_nombre'],$_POST['nuevo_direccion'],$_POST['nuevo_email'],$_POST['nuevo_pwd'], "");

    if($cli->insertar($link->link)){
        $datos = $cli->buscar($link->link);
        $cliente = array('dniCliente' => $datos['dniCliente'],'nombre' => $datos['nombre'],'email' => $datos['email']);
        echo json_encode($cliente);
    }
    
    $link->link->close();

?>
