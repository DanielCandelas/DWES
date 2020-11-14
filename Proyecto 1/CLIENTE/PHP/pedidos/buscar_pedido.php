
<?php
    require "../../../php/modelo.php";
    $link=new Bd;
    $id = $_POST['idPedido'];
    $pedido= new Pedido ($id, "", "", "", "" ,"");

    $datos = $pedido->buscar($link->link);

    $pedidos = array('idPedido' => $datos['idPedido'],'fecha' => $datos['fecha'],'cliente' => $datos['dniCliente'], 'direccion'=>$datos['dirEntrega']);

    echo json_encode($pedidos);

    $link->link->close();
?>