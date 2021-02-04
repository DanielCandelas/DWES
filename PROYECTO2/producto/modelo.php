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

class Productos {

		private $idProducto;
		private $nombre;
		private $origen;
		private $foto;
		private $marca;
		private $categoria;
		private $peso;
		private $unidades;
		private $volumen;
		private $precio;
		

		static function getAll($link) {
			try{
				$consulta="SELECT * FROM productos";
				$result=$link->prepare($consulta);
				$result->execute();
				return $result;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		function __construct($idProducto, $nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio) {
			$this->idProducto=$idProducto;
			$this->nombre=$nombre;
			$this->origen=$origen;
			$this->foto=$foto;
			$this->marca=$marca;
			$this->categoria=$categoria;
			$this->peso=$peso;
			$this->unidades=$unidades;
			$this->volumen=$volumen;
			$this->precio=$precio;
		}

		function __get($var) {
			return $this->$var;
		}		

		function buscar ($link) {
			try{
				$consulta="SELECT * FROM productos where idProducto='$this->idProducto'";
				$result=$link->prepare($consulta);
				$result->execute();
				return $result->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		function insertar ($link) {
			try {
				$consulta="INSERT INTO productos (idProducto, nombre, origen, marca, categoria, peso, unidades, volumen, precio) VALUES (:idProducto, :nombre, :origen, :marca, :categoria, :peso, :unidades, :volumen, :precio)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idProducto',$idProducto);
				$result->bindParam(':nombre',$nombre);
				$result->bindParam(':origen',$origen);
				$result->bindParam(':marca',$marca);
				$result->bindParam(':categoria',$categoria);
				$result->bindParam(':peso',$peso);
				$result->bindParam(':unidades',$unidades);
				$result->bindParam(':volumen',$volumen);
				$result->bindParam(':precio',$precio);
				$idProducto=$this->idProducto;
				$nombre=$this->nombre;
				$origen=$this->origen;
				$marca=$this->marca;
				$categoria=$this->categoria;
				$peso=$this->peso;
				$unidades=$this->unidades;
				$volumen=$this->volumen;
				$precio=$this->precio;
				$result->execute();
				return $result;
			} catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
		
		function modificar ($link){
			try{
				$consulta="UPDATE productos SET nombre='$this->nombre', origen='$this->origen', marca='$this->marca', categoria='$this->categoria', peso='$this->peso, unidades='$this->unidades, volumen='$this->volumen, precio='$this->precio WHERE idProducto='$this->idProducto'";
				$result=$link->prepare($consulta);
				return $result->execute();
			} catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		function modificarParcial ($link,$input){
			try{
				$fields = getParams($input);
				$consulta = "
          		UPDATE productos
          		SET $fields
          		WHERE idProducto='$this->idProducto'";
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

		function borrar ($link){
			try{
				$consulta="DELETE FROM productos where idProducto='$this->idProducto'";
				$result=$link->prepare($consulta);
				return $result->execute();
			} catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		function columnas ($link) {
			try{
				$result = $link->prepare("DESCRIBE productos");
				$result->execute();
				return $table_fields = $result->fetchAll(PDO::FETCH_COLUMN);				 
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}	
}