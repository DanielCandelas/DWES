
<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $cli = new Cliente ($_POST['dni'], '', '', '', '' ,'');

    $datos = $cli->buscar($base->link);

    $cliente = array('dniCliente' => $datos['dniCliente'],'nombre' => $datos['nombre'],'direccion' => $datos['direccion'],'email' => $datos['email']);

    header('Content-Type: application/json');
    echo json_encode($cliente);

    $base->link->close();
?>