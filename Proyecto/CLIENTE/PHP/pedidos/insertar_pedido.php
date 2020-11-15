<?php

    require "../../../php/modelo.php";
    $link=new Bd;

    $pedido= new Pedido($_POST['nuevo_id'],$_POST['nueva_fecha'],$_POST['nuevo_dir'],$_POST['nuevo_dni']);

    if($pedido->insertar($link->link)){
        $datos = $pedido->buscar($link->link);
        $cliente = new CLiente($datos["dniCliente"],'','','','','');
        $nombre = $cliente->buscar($link->link);
        $datos_pedido = array('idPedido' => $datos['idPedido'],'fecha' => $datos['fecha'], 'cliente'=>$nombre['nombre']);
        echo json_encode($datos_pedido);
    }
    
    $link->link->close();

?>
