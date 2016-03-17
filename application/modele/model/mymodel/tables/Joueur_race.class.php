<?php

class Joueur_race extends Table {

    public $nom;
    public $id_pouvoir;

    public function __construct($nom = "", $id_pouvoir = "") {

        parent::__construct();

        $this->nom=$nom;
        $this->id_pouvoir=$id_pouvoir;

    }
}