<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $fecha2 = $_POST['fecha'];

    $fecha = date_create($fecha2);
    $fecha =  date_format($fecha, 'Y-m-d');


    $pedido = new Pedidos($_POST['idPedido'], $_POST['dniCliente'], $fecha);

    $result = $pedido->insertar($base->link);

	header('Content-Type: application/json');	
	echo json_encode($result);
    
    $base->link->close();

  
?>
