<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	echo "<form>
		<label for='nombre'></br>Nombre</br></label>
      	<input id='nombre' name='nombre'  />

   		<label for='contraseña'></br>Contraseña</br></label>
   		<input id='contraseña' type='password' maxlength='9' />
   		
   		</br>
   		<label for='casillas'></br>Elige las opciones deseadas</br></label>
   		<input id='casillas' type='checkbox' />Opcion 1</br>   		
   		<input id='casillas' checked='checked' type='checkbox' />Opcion 2</br>
   		<input id='casillas' type='radio' />Opcion 3</br>
   		<input id='casillas' checked='checked' type='radio' />Opcion 4</br>
   		</br>
   		<select>
   			<option>DWEC</option></br>
   			<option selected='selected'>DWES</option></br>
   			<option>EIE</option> </br>  			
   		</select></br></br>

   		<textarea></textarea></br>

   		<input id='archivo' type='file' /></br>

   		</br>
   		<input id='Reset' type='submit' value='Reset' />
   		</br>
   		
   		
	</form>";


	?>

</body>
</html>