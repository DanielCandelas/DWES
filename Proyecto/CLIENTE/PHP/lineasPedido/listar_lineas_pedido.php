<?php
    
    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();
    $pedidos = new lineasPedido($_POST['idPedido'], '', '', '');

    $aux = $pedidos->listarLineasPedido($base->link);

    $result = array();

    while($fila = $aux->fetch_assoc()){
        array_push($result, array(           
            'nlinea' => $fila['nlinea'],
            'cantidad' => $fila['cantidad'],
            'idProducto' => $fila["idProducto"]
        ));
    }

    header('Content-Type: application/json');	
    echo json_encode($result);

    $base->link->close();
?>