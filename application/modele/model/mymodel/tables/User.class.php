<?php

class User extends Table {

    public $civilite;
    public $nom;
    public $prenom;
    public $mdp;
    public $adresse;
    public $admin;

    public function __construct($c = "", $n = "", $p = "", $mdp = "", $a = "", $ad = "") {

        parent::__construct();

        $this->civilite = $c;
        $this->nom = $n;
        $this->prenom = $p;
        $this->mdp = $mdp;
        $this->adresse = $a;
        $this->admin = $ad;

    }
}