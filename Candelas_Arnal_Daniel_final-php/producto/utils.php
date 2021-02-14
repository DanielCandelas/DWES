<?php

  //Obtener parametros para updates
  function getParams($input) {

    $filterParams = [];

    foreach($input as $param => $value) {
      $filterParams[] = "$param=:$param";
    }
    
    return implode(", ", $filterParams);
	}

  //Asociar todos los parametros a un sql
	function bindAllValues($statement, $params){

		foreach($params as $param => $value) {
				$statement->bindValue(':'.$param, $value);
    }
    
		return $statement;
  }

  function getCampoValor($input) {

    $filterParams = "";

    foreach($input as $param => $value) {      
      $filterParams = $param."='$value'";
    }

    return $filterParams;
	}

  function getUrl($input) {

    $filterParams = "";

    foreach($input as $param => $value) {      
      $filterParams = $param;
    }

    return $filterParams;
	}
?>