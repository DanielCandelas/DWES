<?php

include "../vistas/CORS.php";
include "utils.php";
include "modelo.php";

$base = new Bd();


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['idPedido']))
    {
      //Mostrar un Pedido
      $pedido = new Pedidos($_GET['idPedido'], '','');
      $dato = $pedido->buscarPedidos($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Mostrar todos los Pedidos
      $dato = Pedidos::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Crear un nuevo Pedido
    $pedido = new Pedidos('',$_POST['fecha'],$_POST['dniCliente']);
    $pedido->idPedido=$pedido->calcularIdPedido($base->link);
    if(!$pedido->buscarPedidos($base->link)){
      $pedido->insertarPedido($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($pedido->idPedido);
      exit();
	  }
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    //Borra un Pedido
    $idPedido = $_GET['idPedido'];
    $pedido = new Pedidos($idPedido,'','');
    if($dato=$pedido->borrarPedido($base->link)){
      header("HTTP/1.1 200 OK");
      echo json_encode($idPedido);
      exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    //Actualiza un Pedido
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
