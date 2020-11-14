
<?php
    require "../../../php/modelo.php";

    $link=new Bd;
    $result=Cliente::getAll($link->link);

    $clientes = array();

    while($fila = $result->fetch_assoc()){
        array_push($clientes, array(
            'dniCliente' => $fila['dniCliente'],
            'nombre' => $fila['nombre'],
            'dir' => $fila['direccion'],
            'email' => $fila['email']
        ));
    }
    echo json_encode($clientes);

    $link->link->close();
?>