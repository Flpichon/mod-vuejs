<?php 

class classe_matiere{
    use genos;
    public $id_matiere;
    public $id_classe;
    public $suppr;

    public function __construct() {
        $this->id_matiere = 0;
        $this->id_classe = 0;
        $this->suppr = 0;
    }
}