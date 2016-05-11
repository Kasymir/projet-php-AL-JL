<?php

class Panier_produit extends Table {

    public $id_produit;
    public $id_panier;
    public $version;

    public function __construct($idpr = "" , $idpa = "", $q = "") {

        parent::__construct();

        $this->id_produit = $idpr;
        $this->id_panier = $idpa;
        $this->version = $q;

    }
}