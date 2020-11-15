
<?php
    require "../../../php/modelo.php";
    $link=new Bd;
    $dni = $_POST['dniCliente'];
    $cli= new Cliente ($dni, "", "", "", "" ,"");

    $datos = $cli->buscar($link->link);

    $cliente = array('dniCliente' => $datos['dniCliente'],'nombre' => $datos['nombre'],'dir' => $datos['direccion'],'email' => $datos['email']);

    echo json_encode($cliente);

    $link->link->close();
?>