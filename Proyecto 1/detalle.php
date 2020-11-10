<?php

    session_start();
    require "vistas/inicio.html";

    if (isset($_POST['comprar'])){   //SI hemos enviado el formulario, nos redirige a verCarrito.php             
        
        //Ir a verCarrito.php

    }else {   //Si NO hemos enviado el formulario nos lo muestra
        require "modelo.php";
        $base = new Bd();
        $product = new Productos($_GET['id'],'','','','','','','');
    
        if($aux = $product->productoDetalle($base->link)){ 
             require "vistas/dibujarDetalle.php";        
        } 
    }
