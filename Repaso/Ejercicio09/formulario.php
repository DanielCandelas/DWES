

<?php

    //VARIABLES:

    $lista_opciones;
    $lista_final;


    //CODIGO:

    for ($i = 1; $i <= 4; $i++) { 
        $value = $_POST('opcion_'.$i);
        $value = limpiar($value);
        $lista_opciones['opcion_'.$i] = $value;
    }

    $lista_final = lista('directorio', $lista_opciones);

    
    echo "<form action='subir.php' enctype='multipart/form-data' method='POST'>";
    echo $lista_final;
    echo "<input type='file' name='archivo'> <br/>";
    echo "<input type='submit' name='enviar'> </form>";


    //FUNCIONES:

	function limpiar($campo){        
        $campo = htmlspecialchars($trim($campo));
    }

    function lista($nombre, $arrayOpciones){
        $lineaI = "<select name='".$nombre."'>";
        $lineaF = "</select>";
        $lineaX = "";

        foreach ($arrayOpciones as $key => $value) {
           $lineaX .= "<option value='".$key."'>".$value."</option>";
        }
        
		return $lineaI.$lineaX.$lineaF;            
    }

?>