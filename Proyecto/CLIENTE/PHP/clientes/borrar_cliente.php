<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $cli = new Cliente ($_POST['dni'], '', '', '', '' ,'');

    $result = $cli->borrar($base->link);
    
    $base->link->close();

    header('Content-Type: application/json');	
	echo json_encode($result);
?>