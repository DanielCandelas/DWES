
<?php
    require "../../../php/modelo.php";

    $link=new Bd;
    $result=Pedido::getAll($link->link);

    $pedidos = array();

    while($fila = $result->fetch_assoc()){
        $cliente = new CLiente($fila["dniCliente"],'','','','','');
        $nombre = $cliente->buscar($link->link);
        array_push($pedidos, array(
            'idPedido' => $fila["idPedido"],
            'fecha' => $fila["fecha"],
            'nombre' => $nombre['nombre']
        ));
    }
    
    echo json_encode($pedidos);

    $link->link->close();
?>