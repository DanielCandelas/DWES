<?php

    require "../../../php/modelo.php";

    $base = new Bd();

    $dni = $_POST['dato'];
    $cli= new Cliente ($dni, '', '', '', '' ,'');

    $cli->borrar($base->link);
    
    $base->link->close();
?>