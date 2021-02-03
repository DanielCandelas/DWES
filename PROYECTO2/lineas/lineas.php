<?php

include "modelo.php";

$base= new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un post
      $lineas= new lineasPedido($_GET['idPedido'],'','','',);
      $dato=$lineas->listarLineasPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      $dato=lineasPedido::getAll($base->link);    
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	  }
}


// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $lineas= new lineasPedido($_POST['idPedido'], '',$_POST['idProducto'],$_POST['cantidad']);
    $lineas->nlinea=$lineas->calcular_nLinea($base->link);
    if(!$lineas->buscarLineasPedido($base->link)){
      $lineas->insertarLineasPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['idPedido']." - ".$lineas->nlinea);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
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
