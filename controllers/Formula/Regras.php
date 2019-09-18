<?php

class Regras {

    public function DuplaNeg($no){
        $centro =clone $no;
        $centro->setValor( $centro->getValor()[3]);
        return [
            'esquerda'=>null,
            'centro'=>[ $centro],
            'direita'=>null,
        ];
    }

    public function conjuncao($no){
        $esquerda =clone $no->getEsquerda();
        $direita = clone $no->getDireita();
        return [
            'esquerda'=>null,
            'centro'=>[ $esquerda, $direita],
            'direita'=>null,
        ];
    }

    public function conjuncaoNeg($no){
        $primeiro = clone $no->getEsquerda();
        $segundo = clone $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);
        $segundo->setNegado($segundo->getNegado()+1);

        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];
    }

    public function disjuncao ($no){
    
        $primeiro = clone $no->getEsquerda();
        $segundo = clone $no->getDireita();

        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];

    }

    public function disjuncaoNeg($no){
        $primeiro = clone $no->getEsquerda();
        $segundo = clone $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);
        $segundo->setNegado($segundo->getNegado()+1);


        return [
            'esquerda'=>null,
            'centro'=>[$primeiro,$segundo],
            'direita'=>null,
        ];

    }

    public function condicional($no){
        $primeiro = clone $no->getEsquerda();
        $segundo =  clone $no->getDireita();

        $primeiro->setNegado($primeiro->getNegado()+1);


        return [
            'esquerda'=>[$primeiro],
            'centro'=>null,
            'direita'=>[$segundo],
        ];

    }

    public function condicionalNeg($no){
        $primeiro = clone $no->getEsquerda();
        $segundo = clone $no->getDireita();

        $segundo->setNegado($segundo->getNegado()+1);


        return [
            'esquerda'=>null,
            'centro'=>[$primeiro,$segundo],
            'direita'=>null,
        ];

    }

    public function bicondicional($no){
        $primeiro1 = clone $no->getEsquerda();
        $primeiro2 = clone $primeiro1;

        $segundo1 = clone $no->getDireita();
        $segundo2 = clone $segundo1;

        $primeiro2->setNegado($primeiro2->getNegado()+1);

        $segundo2->setNegado($segundo2->getNegado()+1);

        return [
            'esquerda'=>[$primeiro1,$segundo1],
            'centro'=>null,
            'direita'=>[$primeiro2,$segundo2],
        ];

    }

    public function bicondicionalNeg($no){
        $primeiro1 = clone $no->getEsquerda();
        $primeiro2 = clone $primeiro1;

        $segundo1 = clone $no->getDireita();
        $segundo2 = clone $segundo1;

        $primeiro2->setNegado($primeiro2->getNegado()+1);

        $segundo1->setNegado($segundo1->getNegado()+1);

        return [
            'esquerda'=>[$primeiro1,$segundo1],
            'centro'=>null,
            'direita'=>[$primeiro2,$segundo2],
        ];
    }

}
?>