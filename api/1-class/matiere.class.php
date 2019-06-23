<?php 

class matiere extends projet{
    public $id;
    public $intitule;
    public $suppr;

    public function __construct() {
        $this->id = 0;
        $this->intitule = '';
        $this->suppr = 0;
    }
}