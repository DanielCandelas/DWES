<?php

    include "arnal.php";

    $link = new Conexion();
    $contenido = new Pantalla(); 
    $alquiler = new Alquileres('', '', '', '');
    

    if (isset($_POST['enviar'])){              
        $contenido->cuerpo = "<a href='dca.php'>Volver a Intentarlo</a>";  

        if ($alquiler->existe($link->link)) {
            $contenido->pie = "Ya existe un alquiler con este ID";
        }

    }else {  

        $peliculas = dca($link, 'peliculas', 'idPelicula', 'Titulo');
        $clientes = dca($link, 'clientes', 'idCliente', 'Nombre');
        $empleados = dca($link, 'empleados', 'idEmpleado', 'Nombre');

        $string = "<form action='' method='POST'> 
        Id Alquiler <input type='text'>
        Peliculas: ".$peliculas." 
        Clientes: ".$clientes."
        Empleados: ".$empleados."
        <input type='submit' value='enviar'>";

        $contenido->cuerpo = $string;         
        $contenido->pie = "Rellene el fomulario";
    }