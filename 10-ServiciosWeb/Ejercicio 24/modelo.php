<?php

class Bd {
	private $link;
	function __construct()
	{
		if (!isset ($this->link)) {
			try{
				$this->link= new PDO("mysql:host=localhost;dbname=virtualmarket", "root", "");
				
			} catch(PDOException $e) {
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				require "vista/mensaje.php";
 				die();
 			}
 		}
	}
		
	function __get($var){
		return $this->$var;
	}
}

