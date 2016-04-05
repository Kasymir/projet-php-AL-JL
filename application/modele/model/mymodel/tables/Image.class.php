<?php

class Image extends Table {

    public $url;
    public $img_main;
    public $id_produit;

    public function __construct($u = "", $im = "", $idp = "") {

        parent::__construct();

        $this->url = $u;
        $this->img_main = $im;
        $this->id_produit = $idp;


    }
}