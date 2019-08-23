<?php

include 'No.php';
include 'Conclusao.php';
include 'Premissa.php';


class Argumento {


    private function childrenIsLpred ($pai){
        return $pai->children()->getName()=="LPRED" ? true : false;
    }

    private function encontraFilho($pai){
        $nome = $pai->children()->getName();
        if ($nome =="CONDICIONAL"){
            return $this->condicional($pai->children());
        }
        elseif($nome =="BICONDICIONAL"){
            return $this->bicondicional($pai->children());
        }
        elseif ($nome =="DISJUNCAO"){
            return $this->disjuncao($pai->children());
        }
        elseif($nome =="CONJUNCAO"){
            return $this->conjuncao($pai->children());
        }
        
 
    }

    private function lpred($lpred){
        $negacao=$lpred->attributes()["NEG"];

        if ($negacao==""){
            return ['NEG'=>0, 'PREDICATIVO'=>$lpred->children()];
        }
        elseif($negacao=="~"){
            return ['NEG'=>1, 'PREDICATIVO'=>"~".$lpred->children()];         
        }
        else{
            return ['NEG'=>2, 'PREDICATIVO'=>"~~".$lpred->children()]; 
        }
    }

    private function condicional($condicional){
        $antecendente_xml =$condicional->children()[0];
        $consequente_xml = $condicional->children()[1];
        
        
        if ($this->childrenIsLpred($antecendente_xml)){
            $antecendente_array = $this->lpred($antecendente_xml->children());
            $antecendente_no = new No($antecendente_array['PREDICATIVO'],$antecendente_array['NEG'],'PREDICATIVO',null,null,null,false,null);
        }
        else{
            $antecendente_no = $this->encontraFilho($antecendente_xml);
           
        }
        if ($this->childrenIsLpred($consequente_xml)){
            $consequente_array = $this->lpred($consequente_xml->children());
            $consequente_no = new No($consequente_array['PREDICATIVO'],$consequente_array['NEG'],'PREDICATIVO',null,null,null,false,null);
       

        }
        else{
            $consequente_no = $this->encontraFilho($consequente_xml);
           

        }
        $valor = $antecendente_no->getValor()."→".$consequente_no->getValor();
        return new No($valor,0,'CONDICIONAL',$antecendente_no,null,$consequente_no,false,null);
    }

    private function bicondicional($bicondicional){
        $primario_xml = $bicondicional->children()[0];
        $secundario_xml = $bicondicional->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new No($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null,null,false,null);
    
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new No($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null,null,false,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        }
        $valor = $primario_no->getValor()."↔".$secundario_no->getValor();
        return new No($valor,0,'BICONDICIONAL',$primario_no,null,$secundario_no,false,null);
    }

    private function disjuncao($disjuncao){
        $primario_xml = $disjuncao->children()[0];
        $secundario_xml = $disjuncao->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new No($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null,null,false,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
           
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new No($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null,null,false,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        

        }
        $valor = $primario_no->getValor()."v".$secundario_no->getValor();
        return new No($valor,0,'DISJUNCAO',$primario_no,null,$secundario_no,false,null);


    }

    private function conjuncao($conjuncao){
        $primario_xml = $conjuncao->children()[0];
        $secundario_xml = $conjuncao->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new No($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null,null,false,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml); 

        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new No($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null,null,false,null);

        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);

        }
        $valor = $primario_no->getValor()."^". $secundario_no->getValor();
        return new No($valor,0,'CONJUNCAO',$primario_no,null,$secundario_no,false,null);

    

    }

    public function premissa($premissa){
        if ($premissa->getName()=="PREMISSA"){
            if($this->childrenIsLpred($premissa)){
                $premissa_array = $this->lpred($premissa->children());
                $valor_no = new No ($premissa_array['PREDICATIVO'],$premissa_array['NEG'],'PREMISSA',null,null,null,false,null);
                return new Premissa($valor_no->getValor(), $valor_no);
            }
            else{
                $nome = $premissa->children()->getName();
                if($nome=="CONDICIONAL"){
                    $valor = $this->condicional($premissa->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $valor = $this->bicondicional($premissa->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $valor = $this->disjuncao($premissa->children());
                }
                elseif($nome=="CONJUNCAO"){
                    $valor = $this->conjuncao($premissa->children());
                }
            }
            return new Premissa($valor->getValor(), $valor);
        }
        return false;
    }

    public function conclusao ($conclusao){

        if ($conclusao->getName()=="CONCLUSAO"){
            if($this->childrenIsLpred($conclusao)){
                $conclusao_array = $this->lpred($conclusao->children());
                $valor_no = new No($conclusao_array['PREDICATIVO'],$conclusao_array['NEG'],'CONCLUSAO',null,null,null,false,null);
                return new Conclusao("|- ".$valor_no->getValor(), $valor_no);
            }
            else{
                $nome = $conclusao->children()->getName(); 

                if($nome=="CONDICIONAL"){
                    $valor = $this->condicional($conclusao->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $valor = $this->bicondicional($conclusao->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $valor = $this->disjuncao($conclusao->children());
                   
                }
                elseif($nome=="CONJUNCAO"){
                    $valor = $this->conjuncao($conclusao->children());
                }
            }
            return new Conclusao("|- ".$valor->getValor(), $valor);;

        }
        return false;

    }
}
?>