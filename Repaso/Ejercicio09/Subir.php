

    <?php

    /* Este archivo será el encargado de subir la foto al servidor */


    //--VARIABLES--

    $nombre;
    $nombre_completo;
    $directorio;
    $ext = "jpg";
    $resultado;


    //--CODIGO--
        
    $directorio = $_POST['directorio'];
    $directorio .= "/";

    $nombre = $_FILES['archivo']['name'];

    crear_directorio($directorio);    
    
    if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {

        $resultado = estado_archivo($nombre, $directorio);
        
        if (!$resultado) {
            echo "El archivo tiene que ser del tipo (jpg, png o gif)";
        }

    } else {
        echo "Ha habido un problema al subir el archivo";
    }


    //--HTML DE LA PAGINA--

    echo "<a href='opciones.php'>";

    //--FUNCIONES--

    function crear_directorio($directorio){     //Creamos el dircetorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio);
        }
    }

    function estado_archivo($nombre, $directorio){

        $nombre = $_FILES['archivo']['name'];
        $partes = explode('.', $nombre);    //Deconstruimos el nombre y lo metemos en un array
        $npartes = count($partes);  

        if (is_file($directorio.$nombre)) {    //Vemos si el archivo existe en el directorio

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

        if (($ext == "png") || ($ext == "jpg") || ($ext == "gif")) {    //Comprobamos extension           
            return $nombre_completo;
        } else {
            return false;
        }
    }   


    ?>
