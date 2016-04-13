<?php

class Panier extends Table {

    public $id_user;

    public function __construct($idu = "") {

        parent::__construct();

        $this->id_user = $idu;

    }
}