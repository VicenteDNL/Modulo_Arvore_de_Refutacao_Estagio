<?php

include 'No.php';

class Regras {

    public function conjuncao($no){
        return [
            'esquerda'=>null,
            'centro'=>[ $no->getEsquerda(),$no->getDireita()],
            'direita'=>null,
        ];
    }

    public function conjuncaoNeg($no){
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);
        $segundo->setNegado($segundo->getNegado()+1);

        $primeiro->setValor("~".$primeiro->getValor());
        $segundo->setValor( "~".$segundo->getValor());

        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];
    }

    public function disjuncao ($no){
    
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];

    }

    public function disjuncaoNeg($no){
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);
        $segundo->setNegado($segundo->getNegado()+1);

        $primeiro->setValor("~".$primeiro->getValor());
        $segundo->setValor( "~".$segundo->getValor());

        return [
            'esquerda'=>null,
            'centro'=>[$primeiro,$segundo],
            'direita'=>null,
        ];

    }

    public function condicional($no){
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);

        $primeiro->setValor("~".$primeiro->getValor());

        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];

    }

    public function condicionalNeg($no){
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        $segundo->setNegado($segundo->getNegado()+1);

        $segundo->setValor("~".$segundo->getValor());

        return [
            'esquerda'=>null,
            'centro'=>[$primeiro,$segundo],
            'direita'=>null,
        ];

    }

    public function bicondicional($no){
        $primeiro = $no->getEsquerda();
        $segundo = $no->getDireita();

        $segundo->setNegado($segundo->getNegado()+1);

        $segundo->setValor("~".$segundo->getValor());

        return [
            'esquerda'=>null,
            'centro'=>[$primeiro,$segundo],
            'direita'=>null,
        ];

    }

}
?>