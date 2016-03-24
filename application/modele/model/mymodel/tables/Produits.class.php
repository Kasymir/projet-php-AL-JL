<?php

class Produits extends Table {

    public $titre;
    public $description;
    public $prix;
    public $visible;
    public $nouveaute;
    public $stock;
    public $url_image;
    public $id_categorie;

    public function __construct($t = "", $d = "", $p = "", $v = "", $n = "", $s = "", $ui = "", $idc = "") {

        parent::__construct();

        $this->titre = $t;
        $this->description = $d;
        $this->prix = $p;
        $this->visible = $v;
        $this->nouveaute = $n;
        $this->stock = $s;
        $this->url_image = $ui;
        $this->id_categorie = $idc;

    }
}