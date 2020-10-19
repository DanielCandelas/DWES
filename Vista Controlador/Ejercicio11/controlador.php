
<?php
    require "vistas/inicio.html";
    require "vistas/funciones.php";
    
    if (isset($_POST['enviarOpciones'])){

        require "vistas/formulario.php";
    }elseif (isset($_POST['enviarArchivo'])) {

        if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
            $directorio = $_POST['directorio'];
            $directorio .= "/";
            $nombre = $_FILES['archivo']['name'];
    
            crear_directorio($directorio);
    
            $nombre = estado_archivo($nombre, $directorio);
            
            if ($nombre == false) {
                $mensaje = "El archivo tiene que ser del tipo (jpg, png o gif)";
                require "vistas/mensaje.php";
            } else {
                move_uploaded_file($_FILES['archivo']['tmp_name'], $nombre);
                $mensaje = "el fichero $nombre se ha subido correctamente";
                require "vistas/mensaje.php";
            }
    
        } else {
            $mensaje = "Ha habido un problema al subir el archivo";
            require "vistas/mensaje.php";
        }
    
        $mensaje = "<br> <a href='controlador.php'> Volver a empezar</a>";
        require "vistas/mensaje.php";
        
    }else require "vistas/opciones.html";

    require "vistas/fin.html";

?>

