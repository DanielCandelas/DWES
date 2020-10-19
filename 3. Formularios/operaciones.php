<!DOCTYPE html>
<html>
<head>
	<title>Datos formulario</title>
</head>
<body>

	<?php


	$a = $_POST['num1'];
	$b = $_POST['num2'];
	$oper = $_POST['operacion'];
	$errores;

    if(empty($_POST["num1"])){
        $errores[] = "El numero 1 es requerido";
    }

    if(empty($_POST["num2"])){
        $errores[] = "El numero 2 es requerido";
    }


	if ($oper == "s") {
		$suma = $a + $b;
		echo "$suma";
	}

	if ($oper == "r") {
		$resta = $a - $b;
		echo "$resta";
	}

	if ($oper == "m") {
		$mult = $a * $b;
		echo "$mult";
	}

	if ($oper == "d") {
		$div = $a / $b;
		echo "$div";
	}




	?>

	<ul>
		<?php if(isset($errores)){
		    foreach ($errores as $error){
		        echo "<li> $error </li>";
		    }
		}
		?>
	</ul>

</body>
</html>