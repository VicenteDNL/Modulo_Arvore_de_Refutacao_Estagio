<?php
 class Conclusao {
     protected $valor_str;
     protected $valor_obj;
     protected $simbolo;

     function __construct($valor_str,$simbolo,$valor_obj) {
        $this->valor_str=$valor_str;
        $this->simbolo=$simbolo;
        $this->valor_obj=$valor_obj;
    }

    public function getValorStrConclusao(){
        return $this->valor_str;
    }

    public function setValorStrConclusao($valor_str){
       $this->valor_str=$valor_str;
        
   }

   public function getValorObjConclusao(){
    return $this->valor_obj;
}

    public function setValorObjConclusao($valor_obj){
        $this->valor_obj=$valor_obj;
        
    }

    public function getSimboloConclusao(){
       return $this->simbolo;
            
        }


 }
 ?>