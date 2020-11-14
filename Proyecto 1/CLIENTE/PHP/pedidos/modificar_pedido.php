<?php

    require "../../../php/modelo.php";
    $link=new Bd;

    $pedido= new Pedido($_POST['mod_id'],$_POST['mod_fecha'],$_POST['mod_dir'],$_POST['mod_dni']);

    if($pedido->modificar($link->link)){
        $datos = $pedido->buscar($link->link);
        $cliente = new CLiente($datos["dniCliente"],'','','','','');
        $nombre = $cliente->buscar($link->link);
        $datos_pedido = array('idPedido' => $datos['idPedido'],'fecha' => $datos['fecha'], 'cliente'=>$nombre['nombre']);
        echo json_encode($datos_pedido);
    }
    
    $link->link->close();

?>
