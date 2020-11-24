<?php

    require "vistas/inicio.html";
    require "modelo.php";

    $base = new Bd();
    $datos = Cliente::getAll($base->link);

    require "vistas/mostrar.php";

    $datos->free();
    $base->link->close(); 

    require "vistas/fin.html";

?>