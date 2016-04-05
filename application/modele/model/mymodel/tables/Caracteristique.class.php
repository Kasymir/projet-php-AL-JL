<?php

class Caracteristique extends Table {

    public $nom;

    public function __construct($n = "") {

        parent::__construct();

        $this->nom = $n;

    }
}