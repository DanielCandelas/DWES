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

    class Productos {

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

        static function dibujarPrincipal($link){  //Con este metodo dibujamos principal.php

            $consulta = "SELECT * FROM productos"; //Hacemos una consulta de todos los productos
            $resultado = $link->query($consulta);

            require "vistas/dibujarPrincipal.php"; //Construimos principal.            
        } 

        function productoDetalle($link){  //Nos devuelve todos los datos del producto seleccionado.
            $consulta = "SELECT * FROM productos WHERE idProducto='".$_GET['id']."'";            
            $resultado = $link->query($consulta);
            return $resultado->fetch_assoc();
        } 
    }

    class Cliente {

        private $dni;
        private $nombre;
        private $direccion;
        private $email;
        private $pwd;
        private $administrador;

        function __construct($dni, $nombre, $direccion, $email, $pwd, $administrador){
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->email = $email;
            $this->pwd = $pwd;
            $this->administrador = $administrador;
        }        

        function autenticar ($link){  //Autentica que el dni y la pwd metidos son correctos. Y devuelve el nombre correspondiente a la pwd y Dni.
			$consulta = "SELECT nombre FROM clientes where dniCliente='$this->dni' and pwd='$this->pwd'";
			$resultado = $link->query($consulta);
			return $resultado->fetch_assoc();
        }
        
        function soyAdmin ($link){  //Con este metodo verificamos si el Cliente es admin o no 
            $consulta = "SELECT administrador FROM clientes WHERE dniCliente='$this->dni' and pwd='$this->pwd'";
            $resultado = $link->query($consulta);

            while ($fila = $resultado->fetch_assoc()) {
                foreach ($fila as $key => $value) {
                    return $value;
                }          
            }    
        }
    }

    class Carrito{

    }