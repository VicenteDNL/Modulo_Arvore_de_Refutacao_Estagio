<?php
 class No {
     protected $valor; // STRING - conteudo do "No"
     protected $direita; // OBJECT "No" - ramo descendo no direita (aplicação da regra)
     protected $esquerda; // OBJECT "No" - ramo descendo no esquerda (aplicação da regra)
     protected $centro; // OBJECT "No" - ramo descendo no centro (separação das premissas)
     protected $fechado; // BOOLEAN - ramo esta fechado?
     protected $linha; // INR - linha a qual resultou no nó atual


     public function getValor(){
         return $this->valor=$valor;
     }

     public function setValor($valor){
        $this->valor=$valor;
         
    }

    public function getDireita($direita){
        return $this->direita=$direita;
    }

    public function setDireita($direita){
       $this->direita=$direita;
        
   }
   

 }
 ?>