<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $cli = new Cliente($_POST['dniCliente'], $_POST['nombre'], $_POST['direccion'], $_POST['email'], '', '');

    $result = $cli->insertar($base->link);

	header('Content-Type: application/json');	
	echo json_encode($result);
    
    $base->link->close();

?>
