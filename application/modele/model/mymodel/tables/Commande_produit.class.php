<?php

class Commande_produit extends Table {

    public $id_produit;
    public $id_commande;

    public function __construct($idp = "", $idc = "") {

        parent::__construct();

        $this->id_produit = $idp;
        $this->id_commande = $idc;

    }
}