<?php 

class eleve{
    use genos;
    public $id;
    public $nom;
    public $prenom;
    public $date_naissance;
    public $id_classe;
    public $suppr = 0;

    public function __construct() {
        $this->id = 0;
        $this->nom = '';
        $this->prenom = '';
        $this->suppr = 0;
    }
}