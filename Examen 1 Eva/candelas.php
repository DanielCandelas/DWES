<?php


    class Pantalla {

        private $cabecera =  "Daniel Candelas Arnal";
        private $cuerpo;
        private $pie;

        function __set($property, $value){
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        function __get($var){
            return $this->$var;
        }

        function mostrar(){

            echo $this->cabecera."<br><br>";
            echo $this->cuerpo."<br>";
            echo $this->pie;
        }
    }

