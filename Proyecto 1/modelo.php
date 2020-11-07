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

            $mensaje =  "<p id='name'> Bienvenio/a ".$_SESSION['nombre']."</p>
                <div id='carro'>        
                    <a href='verCarrito.php'><img src='img/carrito.jpg' width='50px' height='50px'></a><br>
                    <p>".$_SESSION['total']."</p>
                </div>
                <div id='images'>";
            
            require "vistas/mensaje.php"; //Mostramos el nombre y el carrito junto al valor de la session total
            
            while($fila=$resultado->fetch_assoc()){ //Recorremos el array que hemos formado con los datos recogido en la BD
                $linea1 = "<div>"; 

                $nombre = $fila['nombre'];
                $foto = $fila['foto'];
                $precio = $fila['precio'];
                
                $linea1 .= "<img src='img/$foto'>
                    <p>$nombre</p>
                    <p>$precio</p>
                    <a href='detalle.php'>Detalle</a>
                </div>";

                $mensaje = $linea1;    
                require "vistas/mensaje.php";  //Formamos <div> y insertamos la informacion necasaria y los mostramos
            }

            $mensaje = "</div>";    
            require "vistas/mensaje.php";
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

        function autenticar ($link){
			$consulta = "SELECT nombre FROM clientes where dniCliente='$this->dni' and pwd='$this->pwd'";
			$resultado = $link->query($consulta);
			return $resultado->fetch_assoc();
        }
        
        function soyAdmin ($link){
            $consulta = "SELECT administrador FROM clientes WHERE dniCliente='$this->dni' and pwd='$this->pwd'";
            $resultado = $link->query($consulta);

            while ($fila = $resultado->fetch_assoc()) {
                foreach ($fila as $key => $value) {
                    return $value;
                }          
            }    
        }
    }