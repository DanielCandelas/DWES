<?php

include "utils.php";
include "modelo.php";

$base = new Bd();

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un post
      $pedido = new Pedidos($_GET['idPedido'], '','');
      $dato = $pedido->buscarPedidos($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar lista de post
      $dato = Pedidos::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $pedido = new Pedidos('',$_POST['fecha'],$_POST['dniCliente']);
    $pedido->idPedido=$pedido->calcularIdPedido($base->link);
    if(!$pedido->buscarPedidos($base->link)){
      $pedido->insertarPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($pedido->idPedido);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$idPedido = $_GET['idPedido'];
  $pedido = new Pedidos($idPedido,'','');
  if($dato=$pedido->borrarPedido($base->link)){
	  header("HTTP/1.1 200 OK");
   	echo json_encode($idPedido);
	  exit();
  }
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{

  if(isset($_GET['idPedido'])){
    $input = $_GET;
    $pedido= new Pedidos($_GET['idPedido'],'','');
    $error=$pedido->modificarPedidoParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo $_GET['idPedido'];
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
