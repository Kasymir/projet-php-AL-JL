<?php

class Extrait extends Table {

    public $nom;
    public $url;
    public $id_produit;

    public function __construct($n = "", $u = "", $idp = "") {

        parent::__construct();

        $this->nom = $n;
        $this->url = $u;
        $this->id_produit = $idp;

    }
}