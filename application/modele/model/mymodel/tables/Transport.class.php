<?php

class Transport extends Table {

    public $nom;
    public $id_Categorie;

    public function __construct($n = "", $idc = "") {

        parent::__construct();

        $this->nom = $n;
        $this->id_Categorie = $idc;

    }
}