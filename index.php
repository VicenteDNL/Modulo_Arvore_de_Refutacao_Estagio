<?php

include 'Argumento.php';
include 'Regras.php';
$xml = simplexml_load_file('Formulas/Formulas_xml/Proposicional7.xml');


$regra = new Argumento;


foreach ($xml as $filhos){
    if ($filhos->getName()=='CONCLUSAO'){
        echo( $regra->conclusao($filhos)->getValor_str());
    }
    else{
        echo( $regra->premissa($filhos)->getValor_str());
    }
}












































?>