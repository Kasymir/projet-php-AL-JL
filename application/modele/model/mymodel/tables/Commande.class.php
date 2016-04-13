<?php

class Commande extends Table {

    public $somme;
    public $id_user;

    public function __construct($s = "", $idu = "") {

        parent::__construct();

        $this->somme = $s;
        $this->id_user = $idu;

    }
}