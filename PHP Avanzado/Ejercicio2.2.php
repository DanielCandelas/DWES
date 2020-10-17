<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 2.2</title>
</head>
<body>

	<?php

		$tabla=array(
			array("Pais" => "Alemania", "Capital" => "Berlin", "Extension" => "557046", "Habitantes" => "78420000"),
			array("Pais" => "Austria", "Capital" =>"Viena", "Extension" => "83849", "Habitantes" => "7614000"),
			array("Pais" => "Belgica", "Capital" =>"Bruselas", "Extension" => "30518", "Habitantes" => "9932000"));

				
		echo "<table border='1'>";

		$primera = true;
		$linea1 = "<tr>";
		$linea2 = "<tr>";

		foreach ($tabla as $value) {					
			foreach ($value as $key => $contenido) {

				if ($primera) {
					$linea1.="<td>$key</td>";
					echo "$linea1";
				}

				$linea2.="<td>$contenido</td>";
				echo "$linea2";
			}			
			if ($primera) {
					$linea1.="</tr>";
					echo "$linea1";
					$primera = false;
				}

				$linea2.="</tr>";
				echo "$linea2";
				$linea2 = "<tr>";

		}

		echo "</table>";

	?>

</body>
</html>