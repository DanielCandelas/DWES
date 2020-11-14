<?php

    require "../../../php/modelo.php";
    $link=new Bd;
    $dni=$_POST['mod_dni'];

    $cliente = new Cliente($dni,"","","","","") ;
    $datos = $cliente->buscar($link->link);

    $cli= new Cliente($_POST['mod_dni'],$_POST['mod_nombre'],$_POST['mod_direccion'],$_POST['mod_email'], $datos['pwd'], $datos['admin']);
    if($cli->modificar($link->link)){
        $cliente = array('dniCliente' => $_POST['mod_dni'],'nombre' => $_POST['mod_nombre'],'email' => $_POST['mod_email']);
        echo json_encode($cliente);
    }
    $link->link->close();

?>
