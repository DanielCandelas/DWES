
<?php
 
    /* Este archivo cogerá los valores entregados por opciones.php y los "limpiara",
    luego los introducira en un array con el que contruiremos un SELECT para finalmente
    mostrar un formulario, desde donde podremos elegir el nombre de nuestro directorio 
    y el archivo que queremos introducir en el. */


//--VARIABLES--

    $lista_opciones;    //array asociativo con el nombre del campo que le pasan y su valor(contenido) 
    $lista_final;       //string que va a contener el SELECT


//--CODIGO--
    
    //Este for() llama a los campos, los limpia y los mete en el array
    for ($i = 1; $i <= 4; $i++) { 
        $value = $_POST['opcion_'.$i];
        $value = limpiar($value);
        $lista_opciones['opcion_'.$i] = $value;  
    }    

    $lista_final = lista('directorio', $lista_opciones);


//--HTML DE LA PAGINA--

    echo "<form action='subir.php' enctype='multipart/form-data' method='POST'>";
    echo "<br>".$lista_final."<br> <br>";
    echo "<input type='file' name='archivo'> <br> <br>";
    echo "<input type='submit' name='enviar'> </form>";



//--FUNCIONES--
    
    function limpiar($campo){   //Esta función limpia la variable que le pasan
        
        $campo = trim($campo);  //Quita los espacios de delante y detras del texto escrito
        $campo = htmlspecialchars($campo);  //Sustituye los caracteres especiales de HTML introducidos en el campo

        return $campo;
    }

    
    function lista($nombre, $arrayOpciones){    //Esta función crea el SELECT

        $lineaI = "<select name='".$nombre."'>";        
        $lineaX = "";
        $lineaF = "</select>";

        foreach ($arrayOpciones as $key => $value) {
           $lineaX .= "<option value='".$value."' name='".$key."'>".$value."</option>";
        }
        
		return $lineaI.$lineaX.$lineaF;            
    }

?>