<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

include "modelo.php";

$base= new Bd();


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if ((isset($_GET['idPedido'])) && (isset($_GET['nlinea']))) //Busca una linea
    {
      $lineas= new lineasPedido($_GET['idPedido'],$_GET['nlinea'],'','',);
      $dato=$lineas->buscarLineasPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  } else if (isset($_GET['idPedido'])) {  // Busca todas las lineas de un Pedido
      $lineas= new lineasPedido($_GET['idPedido'],'','','',);
      $dato=$lineas->listarLineasPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  } else {
      $dato=lineasPedido::getAll($base->link);   // Devuelve todas las lineas de todos los Pedidos
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	  }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Crea una nueva linea de Pedido
    $lineas= new lineasPedido($_POST['idPedido'], '',$_POST['idProducto'],$_POST['cantidad']);
    $lineas->nlinea=$lineas->calcular_nLinea($base->link);
    if(!$lineas->buscarLineasPedido($base->link)){
      $lineas->insertarLineasPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['idPedido']." - ".$lineas->nlinea);
      exit();
	  }
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  //Borra una linea de pedido
  $idPedido = $_GET['idPedido'];
  $lineas= new lineasPedido($_GET['idPedido'],$_GET['nlinea'],'','',);
  if($dato=$lineas->borrarLineaPedido($base->link)){
	  header("HTTP/1.1 200 OK");
   	echo json_encode($idPedido);
	  exit();
  }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
