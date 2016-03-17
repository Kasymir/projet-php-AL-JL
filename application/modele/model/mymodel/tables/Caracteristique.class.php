<?php

class Caracteristique extends Table {

    public $nom;
    public $description;
    public $id_produit;

    public function __construct($n = "", $d = "", $idp = "") {

        parent::__construct();

        $this->nom = $n;
        $this->description = $d;
        $this->id_produit = $idp;

    }
}