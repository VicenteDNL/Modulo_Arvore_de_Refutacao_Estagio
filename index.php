<?php

include 'controllers/Formula/Argumento.php';
include 'controllers/Formula/Regras.php';
include 'controllers/Arvore/Gerador.php';

$xml = simplexml_load_file('Formulas/Formulas_xml/Proposicional1.xml');


$arg =new Argumento;
$listaArgumentos = $arg->CriaListaArgumentos($xml);
// var_dump($listaArgumentos);

$no = new Gerador;

$no->inicializar($listaArgumentos['premissas'],$listaArgumentos['conclusao']); // Recebe lista dos argumentos no formato ["premissas"=>array(), "conclusao"=>array()]
// $no->criarArvore();
$teste =$no->getArvore();



function imprimir ($arvore){
    $no = new Gerador;
    $teste =$no->getLinha(1,$arvore)->getValorNo()->getValorPredicado();
     echo "1. ".$teste."<br>";
    $teste2 =$no->getLinha(2,$arvore)->getValorNo()->getValorPredicado();
    echo "2. ".$teste2."<br>";

    $teste3 =$no->getLinha(3,$arvore)->getValorNo()->getValorPredicado();
    $tes =$no->getLinha(3,$arvore)->getValorNo();
    if ($tes->getNegadoPredicado() ==1){
        echo "3. ~".$teste3;
    }
    else{
        echo "3. ".$teste3;
    }
       

}
imprimir ($teste);

?>