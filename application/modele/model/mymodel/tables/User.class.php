<?php

class User extends Table {

    public $civilite;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $adresse;
    public $code_postal;
    public $ville;
    public $admin;

    public function __construct($c = "", $n = "", $p = "",$e = "" , $mdp = "", $a = "", $cp = "", $v = "", $ad = "") {

        parent::__construct();

        $this->civilite = $c;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $e;
        $this->mdp = $mdp;
        $this->adresse = $a;
        $this->code_postal = $cp;
        $this->ville = $v;
        $this->admin = $ad;

    }
}