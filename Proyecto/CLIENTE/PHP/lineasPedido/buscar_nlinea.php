
<?php

    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();
    $pedidos = new lineasPedido($_POST['idPedido'], '', '', '');

    $datos = $pedido->buscarLinea($base->link);

    $result = array('nlinea' => $datos['nlinea']);

    header('Content-Type: application/json');
    echo json_encode($result);

    $base->link->close();
?>