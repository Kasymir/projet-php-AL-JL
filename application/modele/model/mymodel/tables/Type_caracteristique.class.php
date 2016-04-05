<?php

class Type_caracteristique extends Table {

    public $id_type;
    public $id_caracteristique;

    public function __construct($idt = "", $idc = "") {

        parent::__construct();

        $this->id_type = $idt;
        $this->id_caracteristique = $idc;


    }
}