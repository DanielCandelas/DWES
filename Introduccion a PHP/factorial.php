<html>	

<body>
	
	<?php 
		echo "Vamos a calcular el factorial de 5. </br>";

		$n = 5;
		$total = 1;

		for ($i=1; $i <= $n; $i++) { 
			$total = $i * $total;
		}

		/*
			$a = 3;
			$b = $a;
			for($i= $a - 1; $i > 1; $i--) {
				$a *= $i;
			}

		*/

		echo "El factorial de $n es $total. </br>";

		echo "<table border = '1'> 
			<tr> 
				<td> El factorial de </td>
				<td> $n </td>
				<td> es </td>
				<td> $total </td>
			</tr>
		</table> ";

	 ?>

</body>

</html>