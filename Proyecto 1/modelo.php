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

    class Carrito {

        private $id;
        private $nombre_producto;
        private $precio;
        private $cantidad;        
        private $total;


        function __construct($id, $nombre_producto, $precio, $cantidad, $total){
            $this->id = $id;
            $this->nombre_producto = $nombre_producto;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->total = $total;           
        }

        function anadirProducto(){
            $_SESSION['id'][$_SESSION['total']] = $_POST['id'];
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
                    $mensaje .= "<tr> <td>".$_SESSION['id'][$i]."</td> <td>".$_SESSION['nombre_producto'][$i]."</td> <td>".$_SESSION['precio'][$i]."</td> <td>".$_SESSION['cantidad'][$i]."</td> <td>".$importe."</td> </tr>";
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
        private $fecha;
        private $dniCliente;

        function dibujarCarro(){

            $suma_total = 0;
            $mensaje = "<table> <tr> <th>Id</th> <th>Nombre</th> <th>Precio</th> <th>Cantidad</th> <th>Importe</th> </tr>";

            if ($_SESSION['total'] > 0) {
                for($i = 0; $i < $_SESSION['total']; $i++){  
                    $importe = $_SESSION['cantidad'][$i]*$_SESSION['precio'][$i];              
                    $mensaje .= "<tr> <td>".$_SESSION['id'][$i]."</td> <td>".$_SESSION['nombre_producto'][$i]."</td> <td>".$_SESSION['precio'][$i]."</td> <td>".$_SESSION['cantidad'][$i]."</td> <td>".$importe."</td> </tr>";
                    $suma_total += $importe;
                }
            }

            $mensaje .= "<tr> <td></td> <td></td> <td></td> <td>TOTAL</td> <td>$suma_total</td></tr>";
            $mensaje .= "</table><br><a href='validar.php'><button>Terminar</button></a>";

            require "vistas/mensaje.php";  
        }

    }