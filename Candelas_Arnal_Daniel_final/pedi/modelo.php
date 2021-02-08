<?php

class Bd {
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			try{
				$this->link= new PDO("mysql:host=localhost;dbname=virtualmarket", "root", "");
				$this->link->exec("set names utf8mb4");
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
 		}
	}
		
	function __get($var){
		return $this->$var;
	}
}

class Pedidos {

	private $idPedido;
	private $fecha;
	private $dniCliente;

	function __construct($idPedido, $fecha, $dniCliente){
		$this->idPedido = $idPedido;
		$this->fecha = $fecha;
		$this->dniCliente = $dniCliente;
	}

	function __get($var) {
		return $this->$var;
	}

	function __set($property, $value){
		if(property_exists($this, $property)) {
			$this->$property = $value;
		}
	} 

	static function getAll($link) {
		try{
			$consulta="SELECT * FROM pedidos";
			$result=$link->prepare($consulta);
			$result->execute();
			return $result;
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}	

	function buscarPedidos($link){  
		try{
			$consulta = "SELECT * FROM pedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			$result->execute();
			return $result->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}

	function insertarPedido ($link) {
		try {
			
				$consulta="INSERT INTO pedidos (idPedido, fecha, dniCliente) VALUES (:idPedido, :fecha, :dniCliente)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idPedido',$idPedido);
				$result->bindParam(':fecha',$fecha);
				$result->bindParam(':dniCliente',$dniCliente);
				$idPedido=$this->idPedido;
				$fecha=$this->fecha;
				$dniCliente=$this->dniCliente;
				$result->execute();
				return $result;
			
			/*
				$consulta="INSERT INTO pedidos (idPedido, fecha, dniCliente) VALUES ($this->idPedido, $this->fecha, $this->dniCliente)";
				$result=$link->prepare($consulta);
				$result->execute();
				return $result;
			*/
		} catch(PDOException $e) {
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}

	function borrarPedido($link){  
		try{
			$consulta = "DELETE FROM pedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			return $result->execute();
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}

	function modificarPedidoParcial ($link,$input){
		try{
			$fields = getParams($input);
			$consulta = "
			  UPDATE pedidos
			  SET $fields
			  WHERE idPedido='$this->idPedido'";
			  $result=$link->prepare($consulta);
			bindAllValues($result,$input);
			$result->execute();
			return $result;
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}
	
	function calcularIdPedido($link){
        try{
            $consulta="SELECT Max(idPedido) as idPedido FROM pedidos";
            $result=$link->prepare($consulta);
            $result->execute(); 
            foreach ($result->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                    return $value+1;
            }
        }
        catch(PDOException $e){
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
            return $dato;
            die();
        }
    }
}