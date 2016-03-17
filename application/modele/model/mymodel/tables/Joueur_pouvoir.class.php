<?php

class Joueur_pouvoir extends Table {

    public $nom;
    public $description;

    public function __construct($nom = "", $description = "") {

        parent::__construct();

        $this->nom=$nom;
        $this->description=$description;

    }
}