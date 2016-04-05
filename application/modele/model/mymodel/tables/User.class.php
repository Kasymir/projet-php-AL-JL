<?php

class User extends Table {

    public $civilite;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $admin;

    public function __construct($c = "", $n = "", $p = "",$e = "" , $mdp = "", $ad = "") {

        parent::__construct();

        $this->civilite = $c;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $e;
        $this->mdp = $mdp;
        $this->admin = $ad;

    }
}