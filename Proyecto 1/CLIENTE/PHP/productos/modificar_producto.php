<?php

    require "../../../php/modelo.php";
    $link=new Bd;
    $id=$_POST['id'];
    $producto = new Producto($id,"","","","","") ;

    if(isset($_FILES["archivo"])){
        $foto = $_FILES["archivo"];
        $destino = "../../../img/".$foto["name"];
        
        $producto_mod = new Producto($_POST['id'], $_POST['nombre'], $foto["name"], $_POST['material'], $_POST['size'], $_POST['precio']);

        if($producto_mod->modificar($link->link)){
            $datos = $producto->buscar($link->link);

            $datos_json = array('idProducto' => $datos["idProducto"],'nombre' => $datos["nombre"],'foto' => $datos["foto"],'size' => $datos["size"],'precio' => $datos["precio"]);
            echo json_encode($datos_json);
        }

    } else {
        $datos = $producto->buscar($link->link);
        $producto_mod = new Producto($_POST['id'], $_POST['nombre'], $datos["foto"], $_POST['material'], $_POST['size'], $_POST['precio']);

        if($producto_mod->modificar($link->link)){
            $datos = $producto->buscar($link->link);

            $datos_json = array('idProducto' => $datos["idProducto"],'nombre' => $datos["nombre"],'foto' => $datos["foto"],'size' => $datos["size"],'precio' => $datos["precio"]);
            echo json_encode($datos_json);
        }
    }

    $link->link->close();

?>
