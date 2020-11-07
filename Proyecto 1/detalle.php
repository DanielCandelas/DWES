<?php

    session_start();

    require "vistas/inicio.html";

    if (isset($_POST['comprar'])){   //SI hemos enviado el formulario, nos redirige a verCarrito.php             
        //Ir a verCarrito.php

    }else {     //Si NO hemos enviado el formulario nos lo muestra

        require "modelo.php";

        $base = new Bd();
        $product = new Productos($_GET['id'],'','','','','','','');
        $linea = "<p> Bienvenio/a ".$_SESSION['nombre']."</p><br>";
    
        if($aux = $product->dibujarDetalle($base->link)){             
            $foto = $aux['foto'];
            $nombre = $aux['nombre'];
            $origen = $aux['origen'];
            $marca = $aux['marca'];
            $categoria = $aux['categoria'];
            $peso = $aux['peso'];
            $precio = $aux['precio'];

            $linea .= "<div id='detalle'>
            <div id='imagen'><img src='img/$foto' width='200px' height='200px'></div>
            <div id='formulario'><form action='' method='POST'>
                    <br> <input type='text' name='id' hidden value='".$_GET['id']."'>".$_GET['id']."<br/>
                    <br> <input type='text' name='id' hidden value='$nombre'><b>".$nombre."</b><br/><br>
                    <br> <input type='text' name='id' hidden value='".$origen."'>".$origen."<br/>
                    <br> <input type='text' name='id' hidden value='".$marca."'>".$marca."<br/>
                    <br> <input type='text' name='id' hidden value='".$categoria."'>".$categoria."<br/>
                    <br> <input type='text' name='id' hidden value='".$peso."'>".$peso."<br/>
                    <br> <input type='text' name='id' hidden value='".$precio."'>".$precio."<br/>
                    <br> Cantidad: <input type='number' name='cantidad' value='1' min='1'> <br>
                    <br> <input type='submit' name='comprar' value='Comprar'>
                </form></div></div>";           
        } 

        $mensaje = $linea;
        require "vistas/mensaje.php";
    }
