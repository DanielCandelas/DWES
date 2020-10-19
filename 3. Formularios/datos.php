<!DOCTYPE html>
<html>
<head>
	<title>Datos formulario</title>
</head>
<body>

	<?php

	$a = $_POST['num1'];
	$b = $_POST['num2'];
	$c = $_POST['num3'];
	$menor = 0;
	$mayor = 0;

	 	//iniciando mayor y menor a $a
		/*
		if ($b < $menor) {
			$menor = $b;
		} elseif ($c < $menor){
			$menor = $c;
		}

		if ($b > $mayor) {
			$mayor = $b;
		} elseif ($c > $mayor){
			$mayor = $c;
		}
		*/

		//sin iniciar
		if ($a > $b) {
			if ($a > $c) {
				$mayor = $a;
			} else {
				$mayor = $c;
			}
			
		} else if ($b > $c) {
			$mayor = $b;	
		} else {
			$mayor = $c;
		}

		//menor
		if ($a < $b) {
			if ($a < $c) {
				$menor = $a;
			} else {
				$menor = $c;
			}
			
		} else if ($b < $c) {
			$menor = $b;	
		} else {
			$menor = $c;
		}

		echo "El mayor es:  $mayor </br>";
		echo "El menor es:  $menor";
	?>

</body>
</html>