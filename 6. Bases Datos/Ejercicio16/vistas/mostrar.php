<?php
	while ($fila = $datos->fetch_assoc()) {
		foreach ($fila as $key => $value) {
			echo "$key: $value <br>";
		} 
		echo "<br>";           
	}