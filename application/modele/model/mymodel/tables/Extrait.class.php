<?php

class Extrait extends Table {

    public $nom;
    public $url;
    public $type;
    public $id_produit;

    public function __construct($n = "", $u = "",$t = "", $idp = "") {

        parent::__construct();

        $this->nom = $n;
        $this->url = $u;
        $this->type = $t;
        $this->id_produit = $idp;

    }
}