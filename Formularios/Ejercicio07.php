<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 07</title>
</head>
<body>

	<?php

		$error = False;

		if (isset($_GET['enviar'])) {

			//Comprobamos si hay algun campo vacio 
			if (empty($_GET['nombre']) || empty($_GET['apellidos']) || empty($_GET['domicilio'])){  

				echo "<h3> Hay un error </h3>";
				$error = True;

			} else {

				//Recorremos el array $_GET para leer los datos que hemos introducido, los metemos en un array asociativo y los mostramos.
				foreach ($_GET as $key => $value) {					
					$array[$key] = $value;
					echo "$key: ".$array[$key]."<br/>";
				}
			}

		}

			
		if (!isset($_GET['enviar']) || $error){	 //Si NO le damos a Enviar o hay algun ERROR mostramos el formulario.

			echo "<form action=''>"; //El action tiene que estar vacio y por defecto el method es GET
			echo "Nombre: <br/> <input type='text' name='nombre'> <br/> <br/>";
			echo "Apellidos: <br/> <input type='text' name='apellidos'> <br/> <br/>";
			echo "Domicilio: <br/> <input type='text' name='domicilio'> <br/> <br/>";

			echo "<input type='submit' name='enviar'> <br/> </form>";	
		}	

	?>

</body>
</html>


