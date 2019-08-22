<?php
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
            return $lpred->children();
        }
        elseif($negacao=="~"){
            return "~".$lpred->children();           
        }
        else{
            return "~~".$lpred->children();
        }
    }

    private function condicional($condicional){
        $antecendente =$condicional->children()[0];
        $consequente = $condicional->children()[1];
        
        
        if ($this->childrenIsLpred($antecendente)){
            $antecendente_str = $this->lpred($antecendente->children());

        }
        else{
           $antecendente_str = $this->encontraFilho($antecendente);

        }
        if ($this->childrenIsLpred($consequente)){
            $consequente_str = $this->lpred($consequente->children());

        }
        else{
           $consequente_str = $this->encontraFilho($consequente);

        }

        // $resposta=[
        //     'texto'=> $primario_str."v".$secundario_str,
        //     'esquerda_1'=>$primario_str,
        //     'direita_1' =>$secundario_str,
        // ];
        return $antecendente_str."→".$consequente_str;
    }

    private function bicondicional($bicondicional){
        $primario = $bicondicional->children()[0];
        $secundario = $bicondicional->children()[1];
        if ($this->childrenIsLpred($primario)){
            $primario_str = $this->lpred($primario->children());

        }
        else{
           $primario_str = $this->encontraFilho($primario);

        }
        if ($this->childrenIsLpred($secundario)){
            $secundario_str = $this->lpred($secundario->children());

        }
        else{
           $secundario_str = $this->encontraFilho($secundario);

        }
        return $primario_str."↔".$secundario_str;

    }

    private function disjuncao($disjuncao){
        $primario = $disjuncao->children()[0];
        $secundario = $disjuncao->children()[1];
        if ($this->childrenIsLpred($primario)){
            $primario_str = $this->lpred($primario->children());

        }
        else{
           $primario_str = $this->encontraFilho($primario);

        }
        if ($this->childrenIsLpred($secundario)){
            $secundario_str = $this->lpred($secundario->children());

        }
        else{
           $secundario_str = $this->encontraFilho($secundario);

        }
        return $primario_str."v".$secundario_str;

    }

    private function conjuncao($conjuncao){
        $primario = $conjuncao->children()[0];
        $secundario = $conjuncao->children()[1];
        if ($this->childrenIsLpred($primario)){
            $primario_str = $this->lpred($primario->children());

        }
        else{
           $primario_str = $this->encontraFilho($primario);

        }
        if ($this->childrenIsLpred($secundario)){
            $secundario_str = $this->lpred($secundario->children());

        }
        else{
           $secundario_str = $this->encontraFilho($secundario);

        }
        return $primario_str."^".$secundario_str;

    }

    public function premissa($premissa){
        if ($premissa->getName()=="PREMISSA"){
            $premissa_str="";
            if($this->childrenIsLpred($premissa)){
                $premissa_str = $this->lpred($premissa->children());
            }
            else{
                $nome = $premissa->children()->getName();
                if($nome=="CONDICIONAL"){
                    $premissa_str = $premissa_str.$this->condicional($premissa->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $premissa_str = $premissa_str.$this->bicondicional($premissa->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $premissa_str = $premissa_str.$this->disjuncao($premissa->children());
                }
                elseif($nome=="CONJUNCAO"){
                    $conclusao_str = $premissa_str.$this->conjuncao($premissa->children());
                }
            }
            return $premissa_str;
        }
        return false;
    }

    public function conclusao ($conclusao){
        if ($conclusao->getName()=="CONCLUSAO"){
            $conclusao_str="|- ";
            if($this->childrenIsLpred($conclusao)){
                $conclusao_str =$conclusao_str.$this->lpred($conclusao->children());
            }
            else{
                $nome = $conclusao->children()->getName(); 

                if($nome=="CONDICIONAL"){
                    $conclusao_str = $conclusao_str.$this->condicional($conclusao->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $conclusao_str = $conclusao_str.$this->bicondicional($conclusao->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $conclusao_str = $conclusao_str.$this->disjuncao($conclusao->children());
                }
                elseif($nome=="CONJUNCAO"){
                    $conclusao_str = $conclusao_str.$this->conjuncao($conclusao->children());
                }
            }
            return $conclusao_str;

        }
        return false;

    }
}
?>