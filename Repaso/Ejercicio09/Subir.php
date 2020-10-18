

    <?php

    /* Este archivo será el encargado de subir la foto al servidor */


//--VARIABLES--

    $nombre;
    $nombre_completo;
    $directorio;
    $ext = "jpg";
    $resultado;


//--CODIGO--

    if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {

        $directorio = $_POST['directorio'];
        $directorio .= "/";

        $nombre = $_FILES['archivo']['name'];

        crear_directorio($directorio);

        move_uploaded_file($_FILES['archivo']['name'], $directorio.$nombre);

        $nombre = estado_archivo($nombre, $directorio);
        
        if ($nombre == false) {
            echo "El archivo tiene que ser del tipo (jpg, png o gif)";
        } else {
            move_uploaded_file($_FILES['archivo']['name'], $directorio.$nombre);
            echo "el fichero $nombre se ha subido correctamente";
        }

    } else {
        echo "Ha habido un problema al subir el archivo";
    }


//--HTML DE LA PAGINA--

    echo "<br> <a href='opciones.php'> Volver a empezar</a>";

//--FUNCIONES--

    function crear_directorio($directorio){     //Creamos el dircetorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio);
        }
    }

    function estado_archivo($nombre, $directorio){  

        if (is_file($directorio.$nombre)) {    //Vemos si el archivo existe en el directorio

            $partes = explode('.', $nombre);    //Deconstruimos el nombre y lo metemos en un array
            $npartes = count($partes); 
            $idUnico = uniqid();                  
            
            if ($npartes > 0) {                
                $nombre = $partes[0];

                for ($i = 1; $i < $npartes-1; $i++) {   //Contruimos el nombre
                    $nombre .= ".".$partes[$i];
                }

                $ext = $partes[$npartes-1];
                $nombre .= "_".$idUnico.".".$ext;   //Nombre 
                $nombre_completo = $directorio.$nombre;   //Nombre completo
            }
        } else {
            echo "El archivo no se encuentra en el directorio";
        }

        if (($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif')) {    //Comprobamos extension           
            return $nombre_completo;
        } else {
            return false;
        }
    }   

    ?>
