<?php

echo "<p> Bienvenio/a ".$_SESSION['nombre']."</p>";
echo "<div id='carro'>";
echo "<a href='verCarrito.php'><img src='img/carrito.jpg'></a><br> <p>".$_SESSION['total']."</p>";
echo "</div><div id='images'>";

while($fila=$resultado->fetch_assoc()){   //Recorremos el array que hemos formado con los datos recogido en la BD
        
    echo "<div>";     
    echo "<img src='img/".$fila['foto']."'>";
    echo "<p>".$fila['nombre']."</p>";
    echo "<p>".$fila['precio']."</p>";
    echo "<a href='detalle.php?id=".$fila['idProducto']."'>Detalle</a>";
    echo "</div>";
}