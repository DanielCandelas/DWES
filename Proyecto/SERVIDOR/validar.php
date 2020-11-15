<?php

    session_start();

    require "vistas/inicio.html";
    require "modelo.php";
    $base = new Bd();    

    if (!isset($_SESSION['nombre'])){
        if (isset($_POST['enviarPwd'])){   //Si hemos enviado el formulario de validacion comprobamos dni y pwd       
            $cli = new Cliente($_POST['dni'],'','','',$_POST['pwd'],'');

            if($nom = $cli->autenticar($base->link)){   //Mediante un metodo autenticar comprobamos si el usuario y la contraseña son correctas
                
                if($admin = $cli->soyAdmin($base->link)){  //Comprobamos si el usuario es administrador o no lo es
                    //Si es administrador hacemos header a CRUD de cliente.
                    header('Location: Proyecto/../../CLIENTE/index.html');
                    
                } else { //Si no es adminstrador creamos 3 variables de sesion y hacemos header a principal.php
                    $_SESSION['nombre'] = $nom['nombre']; 
                    $_SESSION['dni'] = $_POST['dni'];
                    $_SESSION['total'] = 0;
                    header('Location: principal.php');
                }

            } else {
                //El usuario o cantraseña es incorrecto por lo que vuelve a validar.
                $mensaje = "Usuario o contraseña incorrectos <br>";
                $mensaje .= "<a href='validar.php'> Volver </a>";
                require "vistas/mensaje.php";
            }

        } else require "vistas/validacion.php";  
    }  

    if (isset($_SESSION['nombre'])){
        header('Location: principal.php');
    }
    
    require "vistas/fin.html";

?>