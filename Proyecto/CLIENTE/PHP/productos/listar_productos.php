
<?php
    require "../../../php/modelo.php";

    $link=new Bd;
    $result=Producto::getAll($link->link);

    $productos = array();

    while($fila = $result->fetch_assoc()){
        array_push($productos, array(
            'idProducto' => $fila["idProducto"],
            'nombre' => $fila["nombre"],
            'foto' => $fila["foto"],
            'size' => $fila["size"],
            'precio' => $fila["precio"]
        ));
    }
    
    echo json_encode($productos);

    $link->link->close();
?>