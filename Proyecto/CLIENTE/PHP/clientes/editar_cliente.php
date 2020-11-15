<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $cli = new Cliente($_POST['dniCliente'], $_POST['nombre'] ,$_POST['direccion'], $_POST['email'], '', '');

    if($cli->modificar($base->link)){
        $cliente = array('dniCliente' => $_POST['dniCliente'],'nombre' => $_POST['nombre'], 'direccion' => $_POST['direccion'],'email' => $_POST['email']);
        header('Content-Type: application/json');
        echo json_encode($cliente);
    }

    $base->link->close();

?>
