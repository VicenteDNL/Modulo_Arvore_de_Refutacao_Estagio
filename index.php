<?php
include 'no.php';
include 'Argumento.php';
include 'Regras.php';
$xml = simplexml_load_file('Formulas/Formulas_xml/Proposicional5.xml');

$teste =new No;
$regra = new Argumento;


foreach ($xml as $filhos){
    echo $regra->premissa($filhos);
    echo $regra->conclusao($filhos);


}












































?>