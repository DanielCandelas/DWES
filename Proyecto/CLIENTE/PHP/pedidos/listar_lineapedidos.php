
<?php
    require "../../../php/modelo.php";

    $link=new Bd;
    $pedido = new LineaPedido($_POST['idPedido'], '', '', '');

    $result = $pedido->buscar($link->link);

    $lineapedidos = array();

    while($fila = $result->fetch_assoc()){
        array_push($lineapedidos, array(
        	'idPedido' => $fila["idPedido"],
            'idlinea' => $fila["nlinea"],
            'cantidad' => $fila["cantidad"],
        ));
    }
    
    echo json_encode($lineapedidos);

    $link->link->close();
?>