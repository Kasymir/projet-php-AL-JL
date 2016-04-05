<?php

class Composer extends Table {

    public $id_article;
    public $id_caracteristique;
    public $value;

    public function __construct($ida = "", $idc = "", $v = "") {

        parent::__construct();

        $this->id_article = $ida;
        $this->id_caracteristique = $idc;
        $this->value = $v;

    }
}