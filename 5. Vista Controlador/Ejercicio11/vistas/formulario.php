
<?php

$lista_opciones;    
$lista_final;       

for ($i = 1; $i <= 4; $i++) { 
    $value = $_POST['opcion_'.$i];
    $value = limpiar($value);
    $lista_opciones['opcion_'.$i] = $value;  
}    

$lista_final = lista('directorio', $lista_opciones);

echo "<form action='' enctype='multipart/form-data' method='POST'>";
echo "<br>".$lista_final."<br> <br>";
echo "<input type='file' name='archivo'> <br> <br>";
echo "<input type='submit' name='enviarArchivo'> </form>";