<?php
	
	echo "<form action='' method='post' >";
	echo "Nombre del campo:".listarCampos($base->link, 'http://localhost/DWES-2021/PROYECTO2/producto/producto.php?campos', 'Productos')."<br>";
	echo "Valor del campo: <input type='text' name='valor'><br>";
	echo "<input type='submit' name='enviar'> <br> </form>";

	