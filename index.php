<?php

include 'Argumento.php';
include 'Regras.php';
include 'Arvore.php';

$xml = simplexml_load_file('Formulas/Formulas_xml/Proposicional1.xml');






function arrayPremissas($xml){
    $arg = new Argumento;
    $arrayPremissas=[];
    foreach ($xml as $filhos){
        
        if ($filhos->getName()=='PREMISSA'){
            array_push($arrayPremissas, $arg->premissa($filhos));
        }
    }
    return $arrayPremissas;    
}

function arrayConclusao($xml){
    $arg = new Argumento;
    $arrayConclusao=[];
    foreach ($xml as $filhos){
        if ($filhos->getName()=='CONCLUSAO'){
            array_push($arrayConclusao, $arg->conclusao($filhos));
        }
    }
    return  $arrayConclusao;

}


function nosPremissas ($arrayPremissas){
    $listaPremissas =[];
    $linha=0;
    $id=0;
    foreach ($arrayPremissas as $premissa){
        $valor = $premissa->getvalor_str();
        $linha =$linha+1;
        $id= $id+1;
        if ($listaPremissas==[]){
            $noArvore= new Arvore($id,$valor,null,null,$linha,false,null);
            array_push($listaPremissas, $noArvore);
        }
        else{
            $ultimo =end( $listaPremissas);
            $noArvore= new Arvore($id,$valor,$ultimo->getId(),null,$linha,false,null);
            array_push($listaPremissas, $noArvore);
        }
       
        
      return  $listaPremissas;
    }

}



$todasPremissas =arrayPremissas($xml);

 nosPremissas($todasPremissas);

foreach
?>