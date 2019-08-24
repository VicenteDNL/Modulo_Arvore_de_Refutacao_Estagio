<?php
 class Arvore {
    protected $id;
    protected $valor;
    protected $pai;
    protected $loc;
    protected $linha;
    protected $fechado = false;
    protected $linhasFechanento;


    function __construct($id,$valor,$pai,$loc,$linha,$fechado,$linhasFechanento){
        $this->id=$id;
        $this->valor=$valor;
        $this->pai=$pai;
        $this->loc=$loc;
        $this->linha=$linha;
        $this->fechado=$fechado;
        $this->linhasFechanento=$linhasFechanento;

     }

     public function getId(){
         return $this->id;
     }

    
}
?>