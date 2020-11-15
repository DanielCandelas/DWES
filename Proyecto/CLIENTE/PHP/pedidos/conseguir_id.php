<?php
    
    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();

    $pedido = new Pedidos('', '', '', '', '', '');

    $result = $pedido->mayorId($base->link);

    $relleno = array();

    while($fila = $result->fetch_assoc()){
        array_push($relleno, array(
            'idMayor' => $fila['idPedido']
        ));       
    }

    echo json_encode($relleno);

    $base->link->close();
?>