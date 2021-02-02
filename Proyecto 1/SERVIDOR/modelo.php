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
        
        static function getAll($link){
            $consulta = 'SELECT * FROM clientes';
            return $result = $link->query($consulta);
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

        function insertar ($link){  //Con este metodo insertamos un nuevo Cliente en la BD (Cliente)
            $consulta = "INSERT INTO clientes VALUES ('$this->dni','$this->nombre','$this->direccion','$this->email', '', '')";
            return $link->query($consulta);
        }

        function modificar ($link){  //Con este metodo editamos un Cliente en la BD (Cliente)
            $consulta="UPDATE clientes SET nombre='$this->nombre',  direccion='$this->direccion',  email='$this->email' WHERE dniCliente='$this->dni'";
            return $link->query($consulta);
        }

        function borrar ($link){  //Con este metodo borramos un Cliente de la BD (Cliente)
            $consulta = "DELETE FROM clientes where dniCliente='$this->dni'";
            return $link->query($consulta);
        }

        function buscar ($link){  //Con este metodo buscamos un Cliente de la BD (Cliente)
            $consulta = "SELECT * FROM clientes where dniCliente='$this->dni'";
            $result = $link->query($consulta);
            return $result->fetch_assoc();
        }

        function rellenoSelect ($link){  //Con este metodo buscamos los dni de Clientes de la BD (Cliente)
            $consulta = "SELECT dniCliente FROM clientes";
            return $link->query($consulta);
        }
    }

    class Carrito {

        private $idProducto;
        private $nombre_producto;
        private $precio;
        private $cantidad;        
        private $total;


        function __construct($idProducto, $nombre_producto, $precio, $cantidad, $total){
            $this->idProducto = $idProducto;
            $this->nombre_producto = $nombre_producto;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->total = $total;           
        }

        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        function anadirProducto(){
            $_SESSION['idProducto'][$_SESSION['total']] = $_POST['idProducto'];
            $_SESSION['nombre_producto'][$_SESSION['total']] = $_POST['nombre_producto'];
            $_SESSION['precio'][$_SESSION['total']] = $_POST['precio'];
            $_SESSION['cantidad'][$_SESSION['total']] = $_POST['cantidad'];
            $_SESSION['total']++;            
        }

        function dibujarCarro(){

            $suma_total = 0;

            $mensaje = "<table> <tr> <th>Id</th> <th>Nombre</th> <th>Precio</th> <th>Cantidad</th> <th>Importe</th> </tr>";

            if ($_SESSION['total'] > 0) {
                for($i = 0; $i < $_SESSION['total']; $i++){  
                    $importe = $_SESSION['cantidad'][$i]*$_SESSION['precio'][$i];              
                    $mensaje .= "<tr> <td>".$_SESSION['idProducto'][$i]."</td> <td>".$_SESSION['nombre_producto'][$i]."</td> <td>".$_SESSION['precio'][$i]."</td> <td>".$_SESSION['cantidad'][$i]."</td> <td>".$importe."</td> </tr>";
                    $suma_total += $importe;
                }
            }

            $mensaje .= "<tr> <td></td> <td></td> <td></td> <td>TOTAL</td> <td>$suma_total</td></tr>";
            $mensaje .= "</table><br><a href='confirmar.php'><button>Procesar Pedido</button></a> <a href='principal.php'><button>Seguir Comprando</button></a>";

            require "vistas/mensaje.php";  
        }

    }

    class Pedidos {

        private $idPedido;
        private $dniCliente;
        private $fecha;

        function __construct($idPedido, $dniCliente, $fecha){
            $this->idPedido = $idPedido;
            $this->dniCliente = $dniCliente;
            $this->fecha = $fecha;
        }

        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        static function getAll($link){
            $consulta = 'SELECT * FROM pedidos';
            return $link->query($consulta);
        }

        function calcularId($link){
            $consulta = "SELECT idPedido FROM pedidos";
            $resultado = $link->query($consulta);

            //recorremos el array fila que contiene los id que hemos consegudio con la consulta y devolvemos el mayor
            while ($fila = $resultado->fetch_assoc()){
                foreach ($fila as $value) {
                    $id_mayor = $value;
                }		
            }
            return $id_mayor;             
        }

        function insertarPedido($link){
            $idPedido = $this->idPedido;
            $consulta =  "INSERT INTO pedidos VALUES ($this->idPedido, CURDATE(), '', '', '', '', $this->dniCliente)";
            return $link->query($consulta);              
        }        

        function dibujarCarro(){
            $suma_total = 0;
            $mensaje = "<table> <tr> <th>Id</th> <th>Nombre</th> <th>Precio</th> <th>Cantidad</th> <th>Importe</th> </tr>";

            if ($_SESSION['total'] > 0) {
                for($i = 0; $i < $_SESSION['total']; $i++){  
                    $importe = $_SESSION['cantidad'][$i]*$_SESSION['precio'][$i];              
                    $mensaje .= "<tr> <td>".$_SESSION['idProducto'][$i]."</td> <td>".$_SESSION['nombre_producto'][$i]."</td> <td>".$_SESSION['precio'][$i]."</td> <td>".$_SESSION['cantidad'][$i]."</td> <td>".$importe."</td> </tr>";
                    $suma_total += $importe;
                }
            }
            $mensaje .= "<tr> <td></td> <td></td> <td></td> <td>TOTAL</td> <td>$suma_total</td></tr>";
            $mensaje .= "</table><br><a href='validar.php'><button>Terminar</button></a>";
            require "vistas/mensaje.php";  
        }

        function insertar($link){  //CLIENTE
            //$fecha = $this->fecha;  //El POST nos devuelve un string
            //$fechaFinal = strtotime($fecha); //Convierte el string a formato de fecha en php 
            //$fechaFinal = date('Y-m-d', $fechaFinal);  //Lo comvierte a formato de fecha en MySQL
            
            $consulta = "INSERT INTO pedidos VALUES ($this->idPedido, $this->fecha, '', '', '', '', $this->dniCliente)";
            return $link->query($consulta);              
        }

        function borrarPedido($link){  //CLIENTE
            $consulta = "DELETE FROM pedidos where idPedido='$this->idPedido'";
            return $link->query($consulta);
        }

        function editarPedido($link){  //CLIENTE
            $consulta = "UPDATE pedidos SET fecha='$this->fecha', dniCliente='$this->dniCliente' WHERE idPedido='$this->idPedido'";
            return $link->query($consulta);
        }

        function buscarPedidos($link){  //CLIENTE
            $consulta = "SELECT * FROM pedidos where idPedido='$this->idPedido'";
            $result = $link->query($consulta);
            return $result->fetch_assoc();
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

        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        function insertarLineasPedido($link){
            $consulta = "INSERT INTO lineaspedidos VALUES ($this->idPedido, $this->nlinea, $this->idProducto, $this->cantidad)"; 
            return $link->query($consulta); 
        }

        function listarLineasPedido($link){  //CLIENTE
            $consulta = "SELECT * FROM lineaspedidos where idPedido='$this->idPedido'";
            return $link->query($consulta);            
        }

        function borrarLineaPedido($link){ //CLIENTE
            $consulta = "DELETE FROM lineaspedidos where idPedido='$this->idPedido' AND nlinea='$this->nlinea'";
            return $link->query($consulta);
        }

        function insertarLinea($link){  //CLIENTE
            $consulta = "INSERT INTO lineaspedidos VALUES ($this->idPedido, $this->nlinea, $this->idProducto, $this->cantidad)";
            return $link->query($consulta);              
        }
        
        function buscarLinea($link){  //CLIENTE
            $consulta = "SELECT MAX(nlinea) AS max_linea FROM lineaspedidos where idPedido='$this->idPedido";
            return $link->query($consulta);                                 
        }

    }