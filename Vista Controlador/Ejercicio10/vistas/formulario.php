
<?php

	echo "<form action=''>"; //El action tiene que estar vacio y por defecto el method es GET
	
	echo "Nombre: <br/> <input type='text' name='nombre' value='".$value['nombre']."'> ".$error['nombre']." <br/> <br/>";
	echo "Apellidos: <br/> <input type='text' name='apellidos' value='".$value['apellidos']."'> ".$error['apellidos']." <br/> <br/>";
	echo "Domicilio: <br/> <input type='text' name='domicilio' value='".$value['domicilio']."'> ".$error['domicilio']." <br/> <br/>";

	echo "<input type='submit' name='enviar'> <br/> </form>";