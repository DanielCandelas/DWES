<?php

function listarCampos ($link, $url){    
  $consulta= json_decode(file_get_contents($url), true);

  $string= "<select name='productos'>";
  foreach($consulta as $key => $value){
     $string.= "<option value='".$value."'>".$value."</option>";
  }
  $string.= "</select>"; 
  return $string;
}

function listar($link, $url){
  $consulta= json_decode(file_get_contents($url), true);

  $contenido = false;
  $dato = "";
  foreach ($consulta as $fila) {   
    $dato .= "<br>";  
    foreach ($fila as $key => $valor) {

      if ($key == $_POST['productos']) {
        $dato .= "<strong> $key: $valor</strong><br>";
        $contenido = true;
      } else {      
        $dato.= "$key: $valor<br>";
      }             
    }
    $dato.= "<hr>";  
  }
  require "vistas/mensaje.php";
  return $contenido;
}

