<?php

    class Conexion {
        private $link;

        function __construct(){
            $this->link = new  mysqli('localhost', 'root', '', 'examendaw1eval');

            if ($this->link->connect_errno) {
                echo "Error al conectar con MYSQL ".$link->connect_error;
            } else {        
                $this->link->set_charset('UTF-8');
            }
        }

        function __get($var){
            return $this->$var;
        }
    }

    class Alquileres {
        private $idAlquiler;
        private $pelicula;
        private $cliente;
        private $empleado;

        function __construct($idAlquiler, $pelicula, $cliente, $empleado){
            $this->idAlquiler = $idAlquiler;
            $this->pelicula = $pelicula;
            $this->cliente = $cliente;
            $this->empleado = $empleado;
        }

        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        function __get($var){
            return $this->$var;
        }

        function existe($link){
            $consulta = "SELECT idAlquiler FROM alquileres where idAlquiler='$this->idAlquiler'";
            $result = $link->query($consulta);  
            return $result->fetch_assoc();                 
        }

        function insertar($link){
            $consulta = "INSERT INTO alquileres VALUES ($this->idAlquiler, 'CURDATE()', $this->pelicula, $this->cliente, $this->empleado)";
            return $link->query($consulta);
        }
    }

?>