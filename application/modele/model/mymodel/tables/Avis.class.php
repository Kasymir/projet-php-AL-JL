<?php

class Avis extends Table {

    public $id_produit;
    public $note;
    public $titre;
    public $commentaire;
    public $id_user;

    public function __construct($idp = "", $n = "", $t = "", $c = "", $idu = "" ) {

        parent::__construct();

        $this->id_produit = $idp;
        $this->note = $n;
        $this->titre = $t;
        $this->commentaire = $c;
        $this->id_user = $idu;

    }
}