<?php
 class Predicado {
     protected $valor;
     protected $negado;
     protected $tipo;
     protected $esquerda; 
     protected $direita;


     function __construct($valor,$negado,$tipo,$esquerda,$direita) {
        $this->valor=$valor;
        $this->negado=$negado;
        $this->tipo=$tipo;
        $this->direita=$direita;
        $this->esquerda=$esquerda;
   
   
    }

     public function getValorPredicado(){
         return $this->valor;
     }

     public function setValorPredicado($valor){
        $this->valor=$valor;
         
    }

    
    public function getTipoPredicado(){
        return $this->tipo;
    }

    public function setTipoPredicado($tipo){
       $this->tipo=$tipo;
        
   }

    public function getDireitaPredicado(){
        return $this->direita;
    }

    public function setDireitaPredicado($direita){
       $this->direita=$direita;
        
   }

   public function getEsquerdaPredicado(){
        return $this->esquerda;
    }

    public function setEsquerdaPredicado($esquerda){
       $this->esquerda=$esquerda;
        
   }

   public function getNegadoPredicado(){
    return $this->negado;
}


public function addNegacaoPredicado(){
    $this->negado= $this->negado+1;
}


public function removeNegacaoPredicado($negado){
    $this->negado= $this->negado-1;
}

public function existeEsqDisPredicado(){
    if ($this->esquerda==null && $this->direita==null){
        return true;
    }
    return false;
}
   

 }
 ?>