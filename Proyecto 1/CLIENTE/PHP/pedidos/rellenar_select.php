
<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $cli = new Cliente ('', '', '', '', '' ,'');

    $result = $cli->rellenoSelect($base->link);

    $relleno = array();

    while($fila = $result->fetch_assoc()){
        array_push($relleno, array(
            'dniCliente' => $fila['dniCliente']
        ));       
    }

    echo json_encode($relleno);

    $base->link->close();
?>