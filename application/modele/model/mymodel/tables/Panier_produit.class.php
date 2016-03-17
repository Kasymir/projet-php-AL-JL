<?php

class Panier_produit extends Table {

    public $id_produit;
    public $id_panier;

    public function __construct($idpr = "" , $idpa = "") {

        parent::__construct();

        $this->id_produit = $idpr;
        $this->id_panier = $idpa;

    }
}