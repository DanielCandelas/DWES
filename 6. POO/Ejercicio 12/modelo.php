<?php

class Imagen{

    private $tmp_name;
    private $name;
    private $type;
    
    function __construct($tmp_name, $name, $type){
        $this->tmp_name = $tmp_name;
        $this->name = $name;
        $this->type = $type;
    }    

    function esta_cargado(){
        if (is_uploaded_file($tmp_name)) {
            return true;    
        } else {
            return false;
        }        
    }

    function cambiar_nombre($directorio){
        $partes = explode('.', $name);    //Deconstruimos el nombre y lo metemos en un array
        $npartes = count($partes);
        $type = $partes[$npartes-1];  

        if ($npartes > 0) {                
            $name = $partes[0];
            for ($i = 1; $i < $npartes-1; $i++) {   //Contruimos el nombre
                $name .= ".".$partes[$i];
            }                       
        }

        if (is_file($directorio.$name.".".$type)) {    //Vemos si el archivo existe en el directorio          
           
            $idUnico = uniqid();    
            $name .= "_".$idUnico.".".$type;   //Nombre 
        } else {
            $name .= ".".$type;
        }

        $nombre_completo = $directorio.$name;   //Nombre completo

        if (($type == 'png') || ($type == 'jpg') || ($type == 'gif')) {    //Comprobamos typeension           
            return $nombre_completo;
        } else {
            return false;
        }

    }


    function mover($nombre){
        move_uploaded_file($tmp_name, $nombre);
    }
}