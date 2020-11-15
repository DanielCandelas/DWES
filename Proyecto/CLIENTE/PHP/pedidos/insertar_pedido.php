<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedido = new Pedido($_POST['idPedido'], $_POST['dniCliente'], $_POST['fecha'], '', '', '');

    if($pedido->insertar($link->link)){
        $datos = $pedido->buscar($link->link);
        $cliente = new CLiente($datos["dniCliente"],'','','','','');
        $nombre = $cliente->buscar($link->link);
        $datos_pedido = array('idPedido' => $datos['idPedido'],'fecha' => $datos['fecha'], 'cliente'=>$nombre['nombre']);

        header('Content-Type: application/json');	
	    echo json_encode($result);
    }
    
    $base->link->close();

?>
