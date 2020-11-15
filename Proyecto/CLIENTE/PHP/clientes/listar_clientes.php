
<?php
    require "../../../SERVIDOR/modelo.php";

    $base = new Bd();
    $result = Cliente::getAll($base->link);

    $clientes = array();

    while($fila = $result->fetch_assoc()){
        array_push($clientes, array(
            'dniCliente' => $fila['dniCliente'],
            'nombre' => $fila['nombre']
        ));       
    }

    header('Content-Type: application/json');	
    echo json_encode($clientes);

    $base->link->close();
?>