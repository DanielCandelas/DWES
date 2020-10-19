<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 1</title>
</head>
<body>


	<?php


		$titulos = array('Pais', 'Capital', 'Extension', 'Habitantes');
		$pais1 = array("Alemania", "Berlin", "557046", "78420000");
		$pais2 = array("Austria", "Viena", "83849", "7614000");
		$pais3 = array("Belgica", "Bruselas", "30518", "9932000");


		function verPais($pais){
			foreach ($pais as $value) {
				echo "<td>".$value."</td>"; echo "  ";
			}
		}

		function verTitulos($titulos){
			foreach ($titulos as $value) {
				echo "<th>".$value."</th>"; echo "  ";
			}
		}

		echo "<table border='1'> 
					<tr>";
			verTitulos($titulos); 
		echo "</tr>";
		echo "<tr>";
			verPais($pais1); 
		echo "</tr>";
		echo "<tr>";
			verPais($pais2); 
		echo "</tr>";
		echo "<tr>";
			verPais($pais3);
		echo "</tr>
					</table>";
		


	?>

</body>
</html>