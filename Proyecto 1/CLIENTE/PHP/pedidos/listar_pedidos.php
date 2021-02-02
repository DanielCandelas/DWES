<?php
    
    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();
    $result = Pedidos::getAll($base->link);

    $pedidos = array();

    while($fila = $result->fetch_assoc()){
        array_push($pedidos, array(
            'idPedido' => $fila["idPedido"],            
            'dniCliente' => $fila['dniCliente'],
            'fecha' => $fila["fecha"]
        ));
    }

    header('Content-Type: application/json');	
    echo json_encode($pedidos);

    $base->link->close();
?>