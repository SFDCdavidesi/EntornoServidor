<?php

class Errores{
    private $errores;



    private $mensaje,$error,$donde;
    public function __construct($mensaje,$error,$donde){
        $this->$mensaje=$mensaje;
        $this->$error=$error;
        $this->$donde=$donde;
        $this->$errores[]=$error;
    }
    public function error($error){
        $this->errores[]=$error;
    }
    public function hayError(){
        return is_empty($this->$errores);
    }
    protected function pmuestraErrores(){

        foreach($this->errores as $e){
            echo $e . "<br>\r";
        }
    }
    
}
?>