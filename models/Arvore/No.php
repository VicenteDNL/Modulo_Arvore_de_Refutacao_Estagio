<?php
 class No {
     protected $valor; // OBJECT - conteudo do "No"
     protected $filho_direita; // OBJECT "No" - ramo descendo no direita (aplicação da regra)
     protected $filho_esquerda; // OBJECT "No" - ramo descendo no esquerda (aplicação da regra)
     protected $filho_centro; // OBJECT "No" - ramo descendo no centro (separação das premissas)
     protected $linha; // INR - linha a qual resultou no nó atual
     protected $linha_contradicao; // A linha do nó que encontrou sua contradição
     protected $utilizada; // A linha do nó que encontrou sua contradição


     public function __construct($valor,$filho_esquerda,$filho_centro,$filho_direita,$linha,$linha_contradicao,$utilizada){
         $this->valor = $valor;
         $this->filho_direita = $filho_direita;
         $this->filho_esquerda = $filho_esquerda;
         $this->filho_centro = $filho_centro;
         $this->linha = $linha;
         $this->linha_contradicao = $linha_contradicao;
         $this->utilizada = $utilizada;

     }
     public function getValorNo(){
         return $this->valor;
     }

     public function setValorNo($valor){
        $this->valor=$valor;
         
    }


    public function getFilhoCentroNo(){
        return $this->filho_centro;
        }

    public function setFilhoCentroNo($centro){
        $this->filho_centro=$centro;   
    }
    
    public function getFilhoDireitaNo(){
        return $this->filho_direita;
        }

    public function setFilhoDireitaNo($direita){
        $this->filho_direita=$direita;   
    }

    public function getFilhoEsquerdaNo(){
        return $this->filho_esquerda;
        }

    public function setFilhoEsquerdaNo($esquerda){
        $this->filho_esquerda=$esquerda;   
    }


    public function getLinhaNo(){
        return $this->linha;
        }

    public function setLinhaNo($linha){
        $this->linha=$linha;   
    }

 }
 ?>