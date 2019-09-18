<?php

include 'models/Arvore/No.php';

 class Gerador{
    private $arvore;
    private $ultimalinha=1;

    public function getArvore(){
        return $this->arvore;
    }

    public function getUltimaLinha(){
        return $this->ultimalinha;
    }

    public function getLinha($linha,$arvore){
        $nos=[];    //corrigir retorno mais de um elemento
        if ($arvore->getLinhaNo()==$linha){
            $arvoreRetorno = clone $arvore;
            $arvoreRetorno->setFilhoDireitaNo(null);
            $arvoreRetorno->setFilhoEsquerdaNo(null);
            $arvoreRetorno->setFilhoCentroNo(null);
            return $arvoreRetorno;
        }
        else{
            if($arvore->getFilhoEsquerdaNo()!=null){
                $nos =  $this->getLinha($linha,$arvore->getFilhoEsquerdaNo());
            }
            if($arvore->getFilhoCentroNo()!=null){
                $nos = $this->getLinha($linha,$arvore->getFilhoCentroNo());
            }
            if($arvore->getFilhoDireitaNo()!=null){
                $nos =  $this->getLinha($linha,$arvore->getFilhoDireitaNo());
            }
            return $nos;
        }
    
    }


    private function addLinha(){
        $this->ultimalinha=$this->ultimalinha+1;
    }

    /* Retorna o Melhor nó para aplicação da derivação */


    // private function getNoDerivacao(){
    //     if ($this->arvore!=null){
    //         if (get_class($this->arvore->getValorNo())=="Conclusao" || get_class($this->arvore->getValor())=="Premissa"){
    //             $arvore = $this->arvore->getValorNo()->valor_obj()->getValor();
    //         else{
    //             $arvore = $this->arvore->getValorNo()->getValor();
    //         }
    //         if ($arvore->getTipoPredicado()=="CONJUNCAO"){
    //         }
    //     }
    // }



     /* Está função gera as primeiras linhas da arvores de refutacao, 
     a partir das premissas e conclusão */
    public function inicializar ($premissas,$conclusao){
        $ultimoNo;
        if ($premissas !=null){
            
            foreach ($premissas as $premissa){
                if ($this->arvore==null){
                    $this->arvore = new No($premissa->getValorObjPremissa(),null,null,null,$this->getUltimaLinha(),null,false);
                    $ultimoNo=$this->arvore;
                }
                else{
                    $ultimoNo->setFilhoCentroNo(new No($premissa->getValorObjPremissa(),null,null,null,$this->getUltimaLinha(),null,false));
                    $ultimoNo=$ultimoNo->getFilhoCentroNo();
    
                }
                $this->addLinha(); 
            }
        }
        if ($conclusao !=null){
            $conclusao[0]->getValorObjConclusao()->addNegacaoPredicado();
            $ultimoNo->setFilhoCentroNo(new No($conclusao[0]->getValorObjConclusao(),null,null,null,$this->getUltimaLinha(),null,false));
            $this->addLinha(); 
        }
         
    }

    // public function criarArvore (){
    //     if ($this->arvore!=null){


    //         getNoDerivacao(){}

    //     };
    // }


}   
?>