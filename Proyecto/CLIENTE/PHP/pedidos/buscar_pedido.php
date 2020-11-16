
<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedido = new Pedidos($_POST['idPedido'], '', '');

    $datos = $pedido->buscarPedidos($base->link);

    $result = array('idPedido' => $datos['idPedido'],'dniCliente' => $datos['dniCliente'],'fecha' => $datos['fecha']);

    header('Content-Type: application/json');
    echo json_encode($result);

    $base->link->close();
?>