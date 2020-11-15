
<?php
    require "../../../php/modelo.php";
    $link=new Bd;
    $id = $_POST['dato'];
    
    $datos = array("idP"=>$id);
    
    $producto= new Producto ($id, "", "", "", "" ,"");

    $producto->borrar($link->link);

    echo json_encode($datos);
    
    $link->link->close();
?>