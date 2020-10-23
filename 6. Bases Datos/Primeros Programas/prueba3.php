
<?php

    $link = new mysqli('localhost', 'root', '', 'virtualmarket'); 

    if ($link->connect_errno) {
        echo "Fallo al conectar: ".$link->connect_error;
    }

?>