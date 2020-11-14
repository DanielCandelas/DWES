<?php


echo "<p> Bienvenio/a ".$_SESSION['nombre']."</p><br>";

echo "<div id='detalle'>";
    echo "<div id='imagenDetalle'><img src='img/".$aux['foto']."' width='200px' height='200px'></div>";
    echo "<div id='formulario'><form action='verCarrito.php' method='POST'>";
        echo "<br> <input type='text' name='idProducto' hidden value='".$_GET['id']."'>".$_GET['id']."<br/>";
        echo "<br> <input type='text' name='nombre_producto' hidden value='".$aux['nombre']."'><b>".$aux['nombre']."</b><br/><br>";
        echo "<p>".$aux['origen']."</p>";
        echo "<p>".$aux['marca']."</p> ";
        echo "<p>".$aux['categoria']."</p>";
        echo "<p>".$aux['peso']."</p>";
        echo "<input type='text' name='precio' hidden value='".$aux['precio']."'>".$aux['precio']."<br/>";
        echo "<br> Cantidad: <input type='number' name='cantidad' value='1' min='1'> <br>";
        echo "<br> <input type='submit' name='comprar' value='Comprar'>";
    echo "</form></div>";
echo "</div>";