<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 09</title>
</head>
<body>

    <form action="formulario.php" method="POST">

        <input type="text" name="opcion_1"> <br> <br>
        <input type="text" name="opcion_2"> <br> <br>
        <input type="text" name="opcion_3"> <br> <br>
        <input type="text" name="opcion_4"> <br> <br>

    </form> 
</body>
</html>


<?php

    echo "<form action='formulario.php' method='POST'>";

    echo "<input type='text' name='opcion 1'> <br> <br>";
    echo "<input type='text' name='opcion 2'> <br> <br>";
    echo "<input type='text' name='opcion 3'> <br> <br>";
    echo "<input type='text' name='opcion 4'> </form>";    

?>
