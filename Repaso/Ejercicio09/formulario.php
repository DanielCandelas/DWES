

<?php

    //VARIABLES:

    $lista_opciones;
    $lista_final;
    $aux; 

    $texto1 = $_POST['opcion_1'];
    $texto2 = $_POST['opcion_2'];
    $texto3 = $_POST['opcion_3'];
    $texto4 = $_POST['opcion_4'];

    
    
    $aux['opcion_1'] = $texto1;
    $aux['opcion_2'] = $texto2;
    $aux['opcion_3'] = $texto3;
    $aux['opcion_4'] = $texto4;

    //CODIGO:

    foreach ($aux as $key => $value) {
        $value = limpiar($value);
        $lista_opciones[$key] = $value;
    }

   

    /*
    for ($i = 1; $i <= 4; $i++) { 
        $value = $_POST['opcion_'.$i];
        $value = limpiar($value);
        $lista_opciones['opcion_'.$i] = $value;
    }
    */

    $lista_final = lista('directorio', $lista_opciones);

    
    echo "<form action='subir.php' enctype='multipart/form-data' method='POST'>";
    echo "<br>".$lista_final."<br> <br>";
    echo "<input type='file' name='archivo'> <br> <br>";
    echo "<input type='submit' name='enviar'> </form>";


    //FUNCIONES:

	function limpiar($campo){     
        $campo = trim($campo);
        $campo = htmlspecialchars($campo); 
        return $campo;
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