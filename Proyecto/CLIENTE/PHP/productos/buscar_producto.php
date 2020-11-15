
<?php
    require "../../../php/modelo.php";
    $link=new Bd;
    $dni = $_POST['idProducto'];
    $prod= new Producto ($dni, "", "", "", "" ,"");

    $datos = $prod->buscar($link->link);

    $producto = array('idProducto' => $datos['idProducto'],'nombre' => $datos['nombre'],'foto' => $datos['foto'],'mat' => $datos['material'],'size' => $datos['size'],'precio' => $datos['precio']);

    echo json_encode($producto);

    $link->link->close();
?>