

<?php

	//$_FILES = Un array asociativo de elementos subidos al script en curso a través del método POST.

	if (is_uploaded_file($_FILES['archivo']['tmp_name'])){ 

		//Comprobamos si el archivo temporal existe.
		if (!file_exists(tmpfile())) { 
		 	die("ERROR: no se ha podido abrir el fichero de datos");
		} 

		//Comprobamos si tiene extension		
		$nombre = $_FILES['archivo']['name'];
		$partes = explode('.', $nombre);
		$npartes = $partes.count($partes);
		
		if ($npartes > 1) {
			//Comprobamos si NO existe el directorio y si es asi, lo creamos.
		    $dir = 'img/';		    
		    if(!is_dir($dir)) { 
		    	mkdir($dir);
		    }  

		    //Comprobamos si el archivo esta en el directorio
			if (is_file($dir.$nombre)) {
				# code...
			}
		}

	    

	    //Subimos el archivo a la ubicación que queremos despues de todas la comprobaciones.
	    move_uploaded_file($_FILES['archivo']['tmp_name'], $dir.$nombre); 

	    echo "el archivo $nombre se ha subido correctamente";
	
	} else {
		echo "No se ha podido subir el archivo";
	}


?>