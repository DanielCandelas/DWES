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

        static function getAll($link){
            $consulta = 'SELECT * FROM clientes';
            return $result = $link->query($consulta);
        }

        static function formar_Tabla($link){
            $consulta = "SELECT * FROM clientes";
            $resultado = $link->query($consulta);
            
            while($fila=$resultado->fetch_assoc()){
                $linea1 = "<tr>"; 

                $dni = $fila['dniCliente'];
                
                $linea1 .= "<td>".$fila['dniCliente']."</td>"; 
                $linea1 .= "<td>".$fila['nombre']."</td>";  

                $linea1 .= "<td> <a href='modificar.php?dni=$dni'>modificar</a> </td>
                    <td> <a href='borrar.php?dni=$dni'>borrar</a> </td>
                    <td> <a href='detalle.php?dni=$dni'>detalle</a> </td> </tr>";
                $mensaje = $linea1;    
                require "vistas/mensaje.php";
            }
        } 

        function autenticar ($link){
			$consulta = "SELECT nombre FROM clientes where dniCliente='$this->dni' and pwd='$this->pwd'";
			$result = $link->query($consulta);
			return $result->fetch_assoc();
		}
        
        function buscar($link){
            $consulta = "SELECT * FROM clientes WHERE dniCliente='$this->dni'";    
            $resultado = $link->query($consulta);    
            return  $resultado->fetch_assoc();
        }

        function modificar ($link){
			$consulta = "UPDATE clientes SET nombre='$this->nombre',  direccion='$this->direccion',  email='$this->email', pwd='$this->pwd' WHERE dniCliente='$this->dni'";            
            return $link->query($consulta);
        }       
        

    }