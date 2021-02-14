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

      if (startsWith($value, 'C')) {
        $aux = explode(" ", $value);
        $result = "";
        foreach($aux as $value){
          if ($value == "C") {
            $result .= "C/";
          } else {
            $result.= " ".$value;
          }
        }
        $value = $result;
      }
			$statement->bindValue(':'.$param, $value);
    }
    
		return $statement;
  }

  function startsWith ($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
  }

?>