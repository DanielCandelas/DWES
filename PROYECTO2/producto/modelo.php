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
	
		function __set($property, $value){
			if(property_exists($this, $property)) {
				$this->$property = $value;
			}
		}	
		
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
		
		/* function buscarProductos ($link) {
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
		} */

		function insertarProductos ($link) {
			try {
				$consulta="INSERT INTO productos VALUES (:idProducto, :nombre, :origen, :foto, :marca, :categoria, :peso, :unidades, :volumen, :precio)";
				$result=$link->prepare($consulta);
				$result->bindParam(':idProducto',$idProducto);
				$result->bindParam(':nombre',$nombre);
				$result->bindParam(':origen',$origen);
				$result->bindParam(':foto',$foto);
				$result->bindParam(':marca',$marca);
				$result->bindParam(':categoria',$categoria);
				$result->bindParam(':peso',$peso);
				$result->bindParam(':unidades',$unidades);
				$result->bindParam(':volumen',$volumen);
				$result->bindParam(':precio',$precio);
				$idProducto=$this->idProducto;
				$nombre=$this->nombre;
				$origen=$this->origen;
				$foto=$this->foto;
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

		function borrarProductos ($link){
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
		
		function modificarProductos ($link){
			try{
				$consulta="UPDATE productos SET nombre='$this->nombre', origen='$this->origen', foto='$this->foto', marca='$this->marca', categoria='$this->categoria', peso='$this->peso, unidades='$this->unidades, volumen='$this->volumen, precio='$this->precio WHERE idProducto='$this->idProducto'";
				$result=$link->prepare($consulta);
				return $result->execute();
			} catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}

		function modificarProductosParcial ($link,$input){
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

		function calcular_nProducto($link){
			try{
				$consulta="SELECT Max(idProducto) as idProducto FROM productos";
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

		function nombreCampos ($link) {
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

		function campoValor ($link,$input) {
			try{
				$fields = getCampoValor($input);
				$consulta="SELECT * FROM productos WHERE $fields";
				$result=$link->prepare($consulta);
				$result->execute();
				//return $result->fetch(PDO::FETCH_ASSOC);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				return $result->fetchAll();
				//return $result;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}	
}