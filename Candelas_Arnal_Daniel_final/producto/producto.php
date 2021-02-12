<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

include "utils.php";
include "modelo.php";

$base= new Bd();


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{      
  $campo = getUrl($_GET);

  if (isset($_GET['campos']))
    {
      $pro = new Productos('','','','','','','','','','','','');
      $dato = $pro->nombreCampos($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  } else if(isset($_GET[$campo])){
        $pro = new Productos('','','','','','','','','','','','');
        $dato=$pro->campoValor($base->link,$_GET);
        header("HTTP/1.1 200 OK");
        echo json_encode($dato);
        exit();
      } else {
        $dato = Productos::getAll($base->link);
        $dato->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($dato->fetchAll());
        exit();
      }    
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $pro = new Productos('',$_POST['nombre'],$_POST['origen'],$_POST['foto'],$_POST['marca'],$_POST['categoria'],
    $_POST['peso'],$_POST['unidades'],$_POST['volumen'],$_POST['precio']);
    $pro->idProducto=$pro->calcular_nProducto($base->link);
    if(!$pro->buscarProductos($base->link)){
      $pro->insertarProductos($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($pro->idProducto);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  $pro = new Productos($_GET['idProducto'],'','','','','','','','','','','');
  if($dato=$pro->borrarProductos($base->link)){
	  header("HTTP/1.1 200 OK");
   	echo json_encode($_GET['idProducto']);
	  exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idProducto'])){
    $input = $_GET;
    $pro = new Productos($_GET['idProducto'],'','','','','','','','','','','');
    $error=$pro->modificarProductosParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo $_GET['idProducto'];
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
