<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 2</title>
</head>
<body>

	<?php


		$tabla=array(
			"Pais"=>array("Alemania", "Austria", "Belgica"),
			"Capital" =>array("Berlin", "Viena", "Bruselas"),
			"Extension"=> array("557046", "83849", "30518"),
			"Habitantes" => array("78420000", "7614000", "9932000"));

		
		echo "<table border='1'>";
		foreach ($tabla as $key => $value) {		
			echo "<tr>";
			echo "<th> $key </th>";
			foreach ($value as $contenido) {
				echo "<td> $contenido </td>";
			}
			echo "</tr>";
		}

		
		
		echo "</table>";

	?>

</body>
</html>