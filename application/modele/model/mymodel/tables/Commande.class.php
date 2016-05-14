<?php

class Commande extends Table {

    public $somme;
    public $date_commande;
    public $valide;
    public $id_user;

    public function __construct($s = "", $dc = "", $v = "" ,$idu = "") {

        parent::__construct();

        $this->somme = $s;
        $this->date_commande = $dc;
        $this->valide = $v;
        $this->id_user = $idu;

    }
}