<?php

    include "daniel.php";
    include "candelas.php";
    include "arnal.php";
    

    $link = new Conexion();
    $contenido = new Pantalla(); 
    $alquiler = new Alquileres('', '', '', '');
    

    if (isset($_POST['enviar'])){              
        $contenido->cuerpo = "<a href='dca.php'>Volver a Intentarlo</a>";  
        $alquiler->idAlquiler = $_POST['idAlquiler'];

        

        if ($alquiler->existe($link->link)) {
            $contenido->pie = "Ya existe un alquiler con este ID";
        } else {
            
            $alquiler->cliente = $_POST['idCliente'];
            $alquiler->pelicula = $_POST['idPelicula'];
            $alquiler->empleado = $_POST['idEmpleado'];

            $alquiler->insertar($link->link);
            $contenido->pie = "El registro se ha insertado correctamente";
        }
        $contenido->mostrar();

    }else {  

        $string = "<form action='' method='POST'> 
        Id Alquiler <input type='text' name='idAlquiler'><br>
        Peliculas: ".dca($link->link, 'peliculas', 'idPelicula', 'Titulo')." <br>
        Clientes: ".dca($link->link, 'clientes', 'idCliente', 'Nombre')."<br>
        Empleados: ".dca($link->link, 'empleados', 'idEmpleado', 'Nombre')."<br>
        <input type='submit' name='enviar' value='enviar'><br> </form>";

        $contenido->cuerpo = $string;         
        $contenido->pie = "Rellene el fomulario";
        $contenido->mostrar();
    }

    