<?php
 class Premissa {
     protected $valor_str;
     protected $valor_obj;

     function __construct($valor_str,$valor_obj) {
        $this->valor_str=$valor_str;
        $this->valor_obj=$valor_obj;
    }

    public function getValorStrPremissa(){
        return $this->valor_str;
    }

    public function setValorStrPremissa($valor_str){
       $this->valor_str=$valor_str;
        
   }

   public function getValorObjPremissa(){
    return $this->valor_obj;
}

    public function setValorObjPremissa($valor_obj){
    $this->valor_obj=$valor_obj;
        
    }


 }
 ?>