<?php

    require "../../../SERVIDOR/modelo.php";
    $base = new Bd();

    $dni = $_POST[''];
    $cli= new Cliente ($dni, '', '', '', '' ,'');

    $cli->borrar($base->link);
    
    $base->link->close();
?>