<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedido = new lineasPedido($_POST['idPedido'], $_POST['nlinea'], $_POST['idProducto'], $_POST['cantidad']);

    $result = $pedido->insertarLinea($base->link);

	header('Content-Type: application/json');	
	echo json_encode($result);
    
    $base->link->close();

?>
