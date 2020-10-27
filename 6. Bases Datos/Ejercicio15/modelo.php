<?php

    class Bd {

        private $link;

        function __construct(){

            $this->link = new  mysqli('localhost', 'root', '', 'virtualmarket');

            if ($this->link->connect_errno) {
                $mensaje = "Error al conectar con MYSQL ".$link->connect_error;
                require "vistas/mensaje.php";
            } else {        
                $this->link->set_charset('UTF-8');
            }
        }

        function __get($var){
            return $this->$var;
        }
    }


    class Cliente {

        private $dni;
        private $nombre;
        private $direccion;
        private $email;
        private $pwd;

        function __construct($dni, $nombre, $direccion, $email, $pwd){
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->email = $email;
            $this->pwd = $pwd;
        }

        function buscar($link){
            $consulta = "SELECT * FROM clientes WHERE dniCliente='$this->dni'";

            $resultado = $link->query($consulta);

            return  $resultado->fetch_assoc();
        }


        function insertar($link){
        
            $consulta = "INSERT INTO clientes VALUES('$this->dni', '$this->nombre', '$this->direccion', '$this->email', '$this->pwd')";
    
            $link->query($consulta);
        }
    }