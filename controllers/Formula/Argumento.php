<?php

include 'models/Formula/Predicado.php';
include 'models/Formula/Conclusao.php';
include 'models/Formula/Premissa.php';


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
            return ['NEG'=>0, 'PREDICATIVO'=>$lpred->children()->__toString()];
        }
        elseif($negacao=="~"){
            return ['NEG'=>1, 'PREDICATIVO'=>$lpred->children()->__toString()];         
        }
        else{
            return ['NEG'=>2, 'PREDICATIVO'=>$lpred->children()->__toString()]; 
        }
    }

    private function condicional($condicional){
        $antecendente_xml =$condicional->children()[0];
        $consequente_xml = $condicional->children()[1];
        
        
        if ($this->childrenIsLpred($antecendente_xml)){
       
            $antecendente_array = $this->lpred($antecendente_xml->children());
            $antecendente_no = new Predicado($antecendente_array['PREDICATIVO'],$antecendente_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $antecendente_no = $this->encontraFilho($antecendente_xml);
           
        }
        if ($this->childrenIsLpred($consequente_xml)){
            $consequente_array = $this->lpred($consequente_xml->children());
            $consequente_no = new Predicado($consequente_array['PREDICATIVO'],$consequente_array['NEG'],'PREDICATIVO',null,null);
       

        }
        else{
            $consequente_no = $this->encontraFilho($consequente_xml);
           

        }
        $valor = $antecendente_no->getValorPredicado()."→".$consequente_no->getValorPredicado();
        return new Predicado($valor,0,'CONDICIONAL',$antecendente_no,$consequente_no);
    }

    private function bicondicional($bicondicional){
        $primario_xml = $bicondicional->children()[0];
        $secundario_xml = $bicondicional->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
    
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        }
        $valor = $primario_no->getValorPredicado()."↔".$secundario_no->getValorPredicado();
        return new Predicado($valor,0,'BICONDICIONAL',$primario_no,$secundario_no);
    }

    private function disjuncao($disjuncao){
        $primario_xml = $disjuncao->children()[0];
        $secundario_xml = $disjuncao->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
           
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        

        }
        $valor = $primario_no->getValor()."^".$secundario_no->getValor();
        return new Predicado($valor,0,'DISJUNCAO',$primario_no,$secundario_no);


    }

    private function conjuncao($conjuncao){
        $primario_xml = $conjuncao->children()[0];
        $secundario_xml = $conjuncao->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml); 

        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);

        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);

        }
        $valor = $primario_no->getValor()."^". $secundario_no->getValor();
        return new Predicado($valor,0,'CONJUNCAO',$primario_no,$secundario_no);

    

    }

    private function premissa($premissa){
        if ($premissa->getName()=="PREMISSA"){
            if($this->childrenIsLpred($premissa)){

                $premissa_array = $this->lpred($premissa->children());
                $valor_no = new Predicado ($premissa_array['PREDICATIVO'],$premissa_array['NEG'],'PREMISSA',null,null);
              
                return new Premissa($valor_no->getValorPredicado(), $valor_no);
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
            return new Premissa($valor->getValorPredicado(), $valor);
        }
        return false;
    }

    private function conclusao ($conclusao){
    
        if ($conclusao->getName()=="CONCLUSAO"){
            if($this->childrenIsLpred($conclusao)){
                $conclusao_array = $this->lpred($conclusao->children());
                $valor_no = new Predicado($conclusao_array['PREDICATIVO'],$conclusao_array['NEG'],'CONCLUSAO',null,null);
                return new Conclusao($valor_no->getValorPredicado(),"|- ", $valor_no);
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
            return new Conclusao($valor->getValorPredicado(),"|- ",$valor);;

        }
        return false;

    }

    public function CriaListaArgumentos($xml){
        $arrayPremissas=[];
        $arrayConclusao=[];
        foreach ($xml as $filhos){
            
            if ($filhos->getName()=='PREMISSA'){
                 array_push($arrayPremissas, $this->premissa($filhos));
            }
            if ($filhos->getName()=='CONCLUSAO'){
                array_push($arrayConclusao, $this->conclusao($filhos));
            }
        }
        return $arrayArgumentos= [
            "premissas" =>$arrayPremissas,
            "conclusao" =>$arrayConclusao
        ];    
    }
}





?>