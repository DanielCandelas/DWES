
<?php

    require "../../../php/modelo.php";

    $link=new Bd;

    $foto = $_FILES["archivo"];
    $destino = "../../../img/".$foto["name"];
    move_uploaded_file($foto["tmp_name"], $destino);

    $producto = new Producto($_POST['id'], $_POST['nombre'], $foto["name"], $_POST['material'], $_POST['size'], $_POST['precio']);

    if($producto->insertar($link->link)){
        $datos = $producto->buscar($link->link);
        $datos_json = array('idProducto' => $datos["idProducto"],'nombre' => $datos["nombre"],'foto' => $datos["foto"],'size' => $datos["size"],'precio' => $datos["precio"]);
        echo json_encode($datos_json);
    }
    
    $link->link->close();
?>
