<?php

class User_adresse extends Table {


    public $adresse;
    public $code_postal;
    public $ville;
    public $facturation;
    public $livraison;
    public $id_user;

    public function __construct($a = "", $cp = "", $v = "", $f = "", $l = "", $idu = "") {

        parent::__construct();

        $this->adresse = $a;
        $this->code_postal = $cp;
        $this->ville = $v;
        $this->facturation = $f;
        $this->livraison = $l;
        $this->id_user = $idu;

    }
}