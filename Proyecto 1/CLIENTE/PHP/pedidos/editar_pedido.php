<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedido = new Pedidos($_POST['idPedido'], $_POST['dniCliente'], $_POST['fecha']);

    if($pedido->editarPedido($base->link)){
        $result = array('idPedido' => $_POST['idPedido'], 'dniCliente' => $_POST['dniCliente'], 'fecha' => $_POST['fecha']);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    $base->link->close();

?>
