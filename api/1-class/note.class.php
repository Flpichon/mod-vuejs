<?php 

class note extends projet{
    public $id;
    public $valeur;
    public $id_eleve;
    public $id_matiere;
    public $suppr;

    public function __construct() {
        $this->id = 0;
        $this->id_eleve = 0;
        $this->valeur = 0;
        $this->id_matiere = 0;
        $this->suppr = 0;
    }
}