
<?php

    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();
    $pedido = new lineasPedido($_POST['idPedido'], '', '', '');

    $datos = $pedido->buscarLinea($base->link);

    $result = $datos['max_linea'];

    header('Content-Type: application/json');
    echo json_encode($result);

    $base->link->close();
?>