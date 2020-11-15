
<?php
    require "../../../php/modelo.php";
    $link=new Bd;
    $id = $_POST['idPedido'];
    
    $datos = array("idP"=>$id);
    
    $pedido= new Pedido ($id, "", "", "");
    $lineaspedido = new Lineapedido($id, "", "", "");

    if(($pedido->borrar($link->link)) && ($lineaspedido->borrar($link->link))){
    	echo json_encode($datos);
    }

    
    $link->link->close();
?>