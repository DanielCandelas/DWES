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
        if (is_uploaded_file($this->tmp_name)) {
            return true;    
        } else {
            return false;
        }        
    }

    function cambiar_nombre($directorio){
        if($nom = estado_archivo ($this->name, $directorio)){
            $this->name = $nom;
            return true;
		}else {
			return false;			
        }
    }


    function mover(){
        move_uploaded_file($this->tmp_name, $this->name);
    }
}