<?php

function listarCampos ($link, $url, $tabla){    
  $consulta= json_decode(file_get_contents($url), true);

  $string= "<select name='$tabla'>";
  foreach($consulta as $key => $value){
     $string.= "<option value='".$value."'>".$value."</option>";
  }
  $string.= "</select>"; 
  return $string;
}

function listar($link, $url){
  $consulta= json_decode(file_get_contents($url), true);

  $string= "";
  foreach($consulta as $key => $value){
     $string.= $value."<br>";
  } 
  return $string;
}
