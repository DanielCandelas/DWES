
<?php
    require "vistas/inicio.html";
    require "vistas/funciones.php";
    require "modelo.php";
    
    if (isset($_POST['enviarOpciones'])){

        require "vistas/formulario.php";
    }elseif (isset($_POST['enviarArchivo'])) {

        $imagen = new Imagen($_FILES['archivo']['tmp_name'], $_FILES['archivo']['name'], $_FILES['archivo']['type']);        

        if ($imagen->esta_cargado()) {
            $directorio = $_POST['directorio'];
            $directorio .= "/";
    
            crear_directorio($directorio);
            
            if ($imagen->cambiar_nombre($directorio)) {
                $imagen->mover();                
                $mensaje = "el fichero se ha subido correctamente";
                require "vistas/mensaje.php";
            } else {
                $mensaje = "El archivo tiene que ser del tipo (jpg, png o gif)";
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
