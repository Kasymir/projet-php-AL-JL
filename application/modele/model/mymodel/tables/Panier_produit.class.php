<?php

class Panier_produit extends Table {

    public $id_produit;
    public $id_panier;
    public $quantite;

    public function __construct($idpr = "" , $idpa = "", $q = "") {

        parent::__construct();

        $this->id_produit = $idpr;
        $this->id_panier = $idpa;
        $this->quantite = $q;

    }
}