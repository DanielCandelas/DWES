<?php

require "producto/modelo.php";
require "funcion.php";

$base= new Bd();

if (isset($_POST['enviar'])) {

	if (!listar($base->link, 'http://localhost/Candelas_Arnal_Daniel_final/producto/producto/'.$_POST['productos'].'/'.rawurlencode($_POST['valor']))) {
		$dato = "Los datos introducidos no corresponden con ninguno de nuestros productos";
		require "vistas/mensaje.php";
	} 	
	require "vistas/enlace.php";
}else{	
	require "vistas/formularioProducto.php";
}

if (isset($_POST['enviarApi'])){	// iomn3Noi45S49wvo
	$url="https://losprecios.co/producto/detalles?ID=".urlencode($_POST['id'])."&ClaveAPI=iomn3Noi45S49wvo";
	$datos=json_decode(file_get_contents($url), true);
	
	if($datos['ErrorID'] == 0) {
		require ("vistas/verProducto.php");
	} else {
		$dato = "El ID de Producto no existe";
		require "vistas/mensaje.php";
	}
	require ("vistas/enlace.php");
}else require ("vistas/formularioApi.php");