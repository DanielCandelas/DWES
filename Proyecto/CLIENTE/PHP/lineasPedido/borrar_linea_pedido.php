
<?php
    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $pedidos = new Pedidos('', '', '', $_POST['nlinea'], '', '');

    $result = $pedido->borrarLineaPedido($base->link);  
    
    header('Content-Type: application/json');	
    echo json_encode($result);
    
    $base->link->close();
?>