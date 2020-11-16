<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedido = new Pedidos($_POST['idPedido'], '', '', $_POST['nlinea'], $_POST['idProducto'], $_POST['cantidad']);

    $result = $pedido->insertarLineaPedido($base->link);

	header('Content-Type: application/json');	
	echo json_encode($result);
    
    $base->link->close();

?>
