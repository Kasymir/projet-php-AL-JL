<?php

class Commande extends Table {

    public $somme;
    public $date_commande;
    public $valide;
    public $annule;
    public $id_user;

    public function __construct($s = "", $dc = "", $v = "" , $a = "", $idu = "") {

        parent::__construct();

        $this->somme = $s;
        $this->date_commande = $dc;
        $this->valide = $v;
        $this->annule = $a;
        $this->id_user = $idu;

    }
}