<?php

class User extends Table {

    public $civilite;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $token;
    public $admin;

    public function __construct($c = "", $n = "", $p = "",$e = "" , $mdp = "", $t = "" , $ad = "") {

        parent::__construct();

        $this->civilite = $c;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $e;
        $this->mdp = $mdp;
        $this->token = $t;
        $this->admin = $ad;

    }
}