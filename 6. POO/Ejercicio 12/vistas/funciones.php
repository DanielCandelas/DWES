

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
