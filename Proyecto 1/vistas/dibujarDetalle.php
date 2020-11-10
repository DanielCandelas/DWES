<?php


echo "<p> Bienvenio/a ".$_SESSION['nombre']."</p><br>";

echo "<div id='detalle'>";
    echo "<div id='imagenDetalle'><img src='img/".$aux['foto']."' width='200px' height='200px'></div>";
    echo "<div id='formulario'><form action='' method='POST'>";
        echo "<br> <input type='text' name='id' hidden value='".$_GET['id']."'>".$_GET['id']."<br/>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['nombre']."'><b>".$aux['nombre']."</b><br/><br>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['origen']."'>".$aux['origen']."<br/>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['marca']."'>".$aux['marca']."<br/>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['categoria']."'>".$aux['categoria']."<br/>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['peso']."'>".$aux['peso']."<br/>";
        echo "<br> <input type='text' name='id' hidden value='".$aux['precio']."'>".$aux['precio']."<br/>";
        echo "<br> Cantidad: <input type='number' name='cantidad' value='1' min='1'> <br>";
        echo "<br> <input type='submit' name='comprar' value='Comprar'>";
    echo "</form></div>";
echo "</div>";