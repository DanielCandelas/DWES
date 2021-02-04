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

class lineasPedido{

	private $idPedido;
	private $nlinea;
	private $idProducto;
	private $cantidad; 

	function __construct($idPedido, $nlinea, $idProducto, $cantidad){
		$this->idPedido = $idPedido;
		$this->nlinea = $nlinea;
		$this->idProducto = $idProducto;
		$this->cantidad = $cantidad;
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
			$consulta="SELECT * FROM lineaspedidos";
			$result=$link->prepare($consulta);
			$result->execute();
			return $result;
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}

	function listarLineasPedido($link) {
		try{
			$consulta = "SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
			$result=$link->prepare($consulta);
			$result->execute();
			$result->setFetchMode(PDO::FETCH_ASSOC);
			return $result->fetchAll();
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	} 

	function buscarLineasPedido($link) {
		try{
			$consulta="SELECT * FROM lineaspedidos where idPedido='$this->idPedido' AND nlinea='$this->nlinea'";
			$result=$link->prepare($consulta);
			$result->execute();
			return $result->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			return $dato;
			die();
		}
	}

	function insertarLineasPedido($link){
		$consulta="INSERT INTO lineaspedidos VALUES (:idPedido,:nlinea,:idProducto,:cantidad)";
					$result=$link->prepare($consulta);
					$result->bindParam(':idPedido',$idPedido);
					$result->bindParam(':nlinea',$nlinea);
					$result->bindParam(':idProducto',$idProducto);
					$result->bindParam(':cantidad',$cantidad);
					$idPedido=$this->idPedido;
					$nlinea=$this->nlinea;
					$idProducto=$this->idProducto;
					$cantidad=$this->cantidad;
					$result->execute();
					return $result;
			
		/*
		$consulta = "INSERT INTO lineaspedidos VALUES ($this->idPedido, $this->nlinea, $this->idProducto, $this->cantidad)"; 
		$result=$link->prepare($consulta);
		$result->execute();
		return $result; */
	}	

	function borrarLineaPedido($link){ 		
		try{
			$consulta = "DELETE FROM lineaspedidos where idPedido='$this->idPedido' AND nlinea='$this->nlinea'";
			$result=$link->prepare($consulta);
			return $result->execute();
		} catch(PDOException $e){+
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
			 return $dato;
			 die();
		 }
	}	

	function calcular_nLinea($link){
        try{
            $consulta="SELECT Max(nlinea) as nlinea FROM lineaspedidos where idPedido='$this->idPedido'";
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