<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();    

    $pedido = new Pedidos($_POST['idPedido'], $_POST['dniCliente'], $_POST['fecha']);

    $result = $pedido->insertar($base->link);

    header('Content-Type: application/json');
	echo json_encode($result);
    
    $base->link->close();

  
?>
