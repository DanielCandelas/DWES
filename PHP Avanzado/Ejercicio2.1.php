<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 2.1</title>
</head>
<body>

	<?php

		$tabla=array(
			"titulos" => array('Pais', 'Capital', 'Extension', 'Habitantes'),
			"Alemania" => array("Alemania", "Berlin", "557046", "78420000"),
			"Austria" => array("Austria", "Viena", "83849", "7614000"),
			"Belgica" => array("Belgica", "Bruselas", "30518", "9932000"));

		
		echo "<table border='1'>";
		foreach ($tabla as $key => $value) {		
			echo "<tr>";
			foreach ($value as $contenido) {
				echo "<td> $contenido </td>";
			}
			echo "</tr>";
		}

		
		
		echo "</table>";

	?>

</body>
</html>