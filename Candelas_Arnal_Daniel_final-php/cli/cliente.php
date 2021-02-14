<?php

include "../vistas/CORS.php";
include "utils.php";
include "modelo.php";

$base= new Bd();

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['dniCliente'])) 
    {
      //Muestra un cliente
      $cli= new Cliente($_GET['dniCliente'],'','','','');
      $dato=$cli->buscar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato);
      exit();
	  }
    else {
      //Muestra todos los clientes
      $dato=Cliente::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($dato->fetchAll());
      exit();
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Crea un nuevo cliente
    $cli = new Cliente($_POST['dniCliente'],$_POST['nombre'],$_POST['direccion'],$_POST['email'],$_POST['pwd']);
    if(!$cli->buscar($base->link)){
      $cli->insertar($base->link);
      header("HTTP/1.1 200 OK");
      echo json_encode($_POST['dniCliente']);
      exit();
	  }
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  //Borrar un Cliente
	$dniCliente = $_GET['dniCliente'];
  $cli= new Cliente($dniCliente,'','','','');
  if($dato=$cli->borrar($base->link)){
	  header("HTTP/1.1 200 OK");
   	echo json_encode($dniCliente);
	exit();
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
  //Actualiza un cliente
  if(isset($_GET['dniCliente'])){
    $input = $_GET;
    $cli= new Cliente($_GET['dniCliente'],'','','','');
    $error=$cli->modificarParcial($base->link,$input);
    header("HTTP/1.1 200 OK");
    echo $_GET['dniCliente'];
    exit();
  }
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado devolvemos error
header("HTTP/1.1 400 Bad Request");

?>
