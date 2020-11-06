<?php

    echo "<form action='' method='post'>";

    echo "dniCliente: ".$datos['dniCliente']."<br>";
    echo "<input type='hidden' name='dniCliente' value='".$datos['dniCliente']."'>";

    echo "nombre: <input type='text' name='nombre' value='".$datos['nombre']."'><br>";

    echo "direccion: <input type='text' name='direccion' value='".$datos['direccion']."'><br>";

    echo "email: <input type='text' name='email' value='".$datos['email']."'><br>";

    echo "pwd: <input type='text' name='pwd' value='".$datos['pwd']."'>	<br>";
    
    echo "<input type='submit' name='enviarModificar'><br>";
    echo "</form>";