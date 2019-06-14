<?php 

class classe{
    use genos;
    public $id;
    public $libelle;
    public $numero;
    public $suppr;

    public function __construct() {
        $this->id = 0;
        $this->libelle = '';
        $this->numero = 0;
        $this->suppr = 0;
    }
}