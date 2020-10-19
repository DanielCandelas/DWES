<!DOCTYPE html>
<html>
<head>
	<title>Formulario 3 Numeros</title>
</head>
<body>

	

      

      <?php
      

      if(isset($_POST['enviar'])){
            
            $z = $_POST['num1'];
            $x = $_POST['num2'];
            $y = $_POST['num3'];
            $menor = $z;
            $mayor = $z;

            //iniciando mayor y menor a $a
            
            if ($x < $menor) {
                  $menor = $x;
            } else {
                  $mayor = $x;
            }

            if ($y > $mayor) {
                  $mayor = $y;
            } else {
                  $menor = $y;
            }

            echo "El mayor es:  $mayor </br>";
            echo "El menor es:  $menor </br>";

            $a = $_POST['num1'];
            $b = $_POST['num2'];
            $oper = $_POST['operacion'];

            if ($oper == "s") {
                  $suma = $a + $b;
                  echo "La suma de $a + $b es: $suma";
            }

            if ($oper == "r") {
                  $resta = $a - $b;
                  echo "La resta entre $a y $b es: $resta";
            }

            if ($oper == "m") {
                  $mult = $a * $b;
                  echo "La multiplicacion entre $a y $b es: $mult";
            }

            if ($oper == "d") {
                  $div = $a / $b;
                  echo "La division entre $a y $b es: $div";
            }
      } else {
            echo "<form action='conjunto.php' method='POST'>

            <label for='1 numero'></br>Numero 1</br></label>
            <input name='num1'  type='text' />

            <label for='2 numero'></br>Numero 2</br></label>
            <input name='num2'  type='text' />

            <label for='3 numero'></br>Numero 3</br></label>
            <input name='num3'  type='text' />

            <label for='SelectOperacion'></br>Seleccione operacion</br></label>

            <select name='operacion'>
                  <option value='r'>-</option>
                  <option value='s'>+</option>
                  <option value='m'>*</option>
                  <option value='d'>/</option>
            </select></br></br>

            <input type='submit' name='enviar'>

            </form>";
      }


      


      ?>

</body>
</html>