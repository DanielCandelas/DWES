 <!DOCTYPE html>
<html>
<head>
	<title>Orden Ascendente</title>
</head>
<body>
	<?php
		echo "Ordenar numeros de menor a mayor </br></br>";

		$a = 11;
		$b = 7;
		$c = 23;

		$array = array( $a, $b, $c);

		echo "Sin Ordenar:  ";
		foreach ($array as $val) {
    		print $val;
    		echo " ";
		}

		echo "</br>";
		echo "Ordenado:  ";
		sort($array);

		foreach ($array as $val) {
    		print $val;
    		echo " ";
		}

	?>	
</body>
</html>