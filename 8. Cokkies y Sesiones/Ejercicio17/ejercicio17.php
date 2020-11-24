<?php

/* Inicialmente comprobamos si existe una variable de sesión llamada nombre, si no es así es que se tiene que validar.
Para validarse aparecerá un formulario pidiendo dni y contraseña. Si el dni es igual a 1 y la contraseña también, 
la validación es correcta y crearemos la variable de sesión nombre */

    session_start();

    if (isset($_SESSION['nombre'])) {
            echo "Sesion accedida <a href='ejercicio17.php'> Volver </a>";
    } else {
        if (isset($_POST['enviar'])) {
            $dni = $_POST['dni'];
            $psw = $_POST['psw'];
            if (($dni == 1) && ($psw == 1)) {
                $_SESSION['nombre'] = "Daniel";
            } else {
                echo "Login incorrecto <a href='ejercicio17.php'> Volver </a>";
            }
        } else {
            echo "<form action='' method='POST'> 
            DNI: <br><input type='text' name='dni'><br>
            Contraseña: <br><input type='text' name='psw'><br>
            <input type='submit' name='enviar' value='enviar'>
            </form>";
        }
    }