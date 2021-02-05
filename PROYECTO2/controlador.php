<?php

require "producto/modelo.php";
$base= new Bd();

if (isset($_POST['enviar'])) {
	listar($base->link, 'http://localhost/DWES-2021/PROYECTO2/producto/producto.php'); //recoger variables de sesion
}else{
	require "funcion.php";
	require "vistas/formularioProducto.php";
}