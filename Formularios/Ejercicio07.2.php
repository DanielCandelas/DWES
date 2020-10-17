<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 07 Version 2</title>
</head>
<body>

	<?php

		$errores = False;

		//$value y $error son un array y llama a la key 

		$value['nombre']="";
		$value['apellidos']="";
		$value['domicilio']="";

		$error['nombre']="";
		$error['apellidos']="";
		$error['domicilio']="";

		if (isset($_GET['enviar'])) {

			//Comprobamos si hay algun campo vacio 
			if (empty($_GET['nombre'])){  

				$error['nombre'] = "Insertar un Nombre / Este campo no puede estra vacio";
				$errores = True;
			} else {
				$value['nombre'] = $_GET['nombre'];
			}

			if (empty($_GET['apellidos'])){  

				$error['apellidos'] = "Insertar los Apellidos / Este campo no puede estra vacio";
				$errores = True;
			} else {
				$value['apellidos'] = $_GET['apellidos'];
			}

			if (empty($_GET['domicilio'])){  

				$error['domicilio'] = "Insertar un domicilio / Este campo no puede estra vacio";
				$errores = True;
			} else {
				$value['domicilio'] = $_GET['domicilio'];
			}


			if (!$errores) {
				//Recorremos el array $_GET para leer los datos que hemos introducido, los metemos en un array asociativo y los mostramos.
				foreach ($_GET as $key => $value) {					
					$array[$key] = $value;
					echo "$key: ".$array[$key]."<br/>";
				}
			}

		}

			
		if (!isset($_GET['enviar']) || $errores){	 //Si NO le damos a Enviar o hay algun ERROR mostramos el formulario.

			echo "<form action=''>"; //El action tiene que estar vacio y por defecto el method es GET

			echo "Nombre: <br/> <input type='text' name='nombre' value='".$value['nombre']."'> ".$error['nombre']." <br/> <br/>";

			echo "Apellidos: <br/> <input type='text' name='apellidos' value='".$value['apellidos']."'> ".$error['apellidos']." <br/> <br/>";

			echo "Domicilio: <br/> <input type='text' name='domicilio' value='".$value['domicilio']."'> ".$error['domicilio']." <br/> <br/>";

			echo "<input type='submit' name='enviar'> <br/> </form>";	
		}	

	?>

</body>
</html>