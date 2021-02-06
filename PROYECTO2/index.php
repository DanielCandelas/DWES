<?php

require "producto/modelo.php";
require "funcion.php";

$base= new Bd();

if (isset($_POST['enviar'])) {

	if (!listar($base->link, 'http://localhost/DWES-2021/PROYECTO2/producto/producto/'.$_POST['productos'].'/'.rawurlencode($_POST['valor']))) {
		$dato = "Los datos introducidos no corresponden con ninguno de nuestros productos";
		require "vistas/mensaje.php";
	} 	
	require "vistas/enlace.php";
}else{	
	require "vistas/formularioProducto.php";
}