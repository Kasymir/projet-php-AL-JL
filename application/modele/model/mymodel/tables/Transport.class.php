<?php

class Transport extends Table {

    public $prix;
    public $id_Categorie;

    public function __construct($n = "", $idc = "") {

        parent::__construct();

        $this->prix = $n;
        $this->id_Categorie = $idc;

    }
}