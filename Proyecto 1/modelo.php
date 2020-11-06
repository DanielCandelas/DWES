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


    class productos {

        private $idProducto;
        private $nombre;
        private $origen;
        private $foto;
        private $marca;
        private $categoria;
        private $peso;
        private $precio;


        function __construct($idProducto, $nombre, $origen, $foto, $marca, $categoria, $peso, $precio){
            $this->idProducto = $idProducto;
            $this->nombre = $nombre;
            $this->origen = $origen;
            $this->foto = $foto;
            $this->marca = $marca;
            $this->categoria = $categoria;
            $this->peso = $peso;
            $this->precio = $precio;
        }




    }