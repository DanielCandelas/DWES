

<?php

//FUNCIONES formulario.php
    function limpiar($campo){   //Esta función limpia la variable que le pasan
            
        $campo = trim($campo);  //Quita los espacios de delante y detras del texto escrito
        $campo = htmlspecialchars($campo);  //Sustituye los caracteres especiales de HTML introducidos en el campo

        return $campo;
    }


    function lista($nombre, $arrayOpciones){    //Esta función crea el SELECT

        $linea = "<select name='".$nombre."'>"; 

        foreach ($arrayOpciones as $key => $value) {
            if (!empty ($value)) {
                $linea .= "<option value='".$value."' name='".$key."'>".$value."</option>";
            }           
        }
        
        $linea .= "</select>";

        return $linea;            
    }

    function crear_directorio($directorio){     //Creamos el dircetorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio);
        }
    }

//FUNCIONES subir.php
    function estado_archivo($nombre, $directorio){  

        $partes = explode('.', $nombre);    //Deconstruimos el nombre y lo metemos en un array
        $npartes = count($partes);
        $ext = $partes[$npartes-1];  

        if ($npartes > 0) {                
            $nombre = $partes[0];

            for ($i = 1; $i < $npartes-1; $i++) {   //Contruimos el nombre
                $nombre .= ".".$partes[$i];
            }                       
        }

        if (is_file($directorio.$nombre.".".$ext)) {    //Vemos si el archivo existe en el directorio            
           
            $idUnico = uniqid();    
            $nombre .= "_".$idUnico.".".$ext;   //Nombre 

        } else {
            $nombre .= ".".$ext;
        }

        $nombre_completo = $directorio.$nombre;   //Nombre completo

        if (($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif')) {    //Comprobamos extension           
            return $nombre_completo;
        } else {
            return false;
        }
    }