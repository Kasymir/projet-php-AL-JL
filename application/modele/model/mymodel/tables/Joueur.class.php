<?php

class Joueur extends Table {

    public $pseudo;
    public $mot_de_passe;
    public $age;
    public $sexe;
    public $race;
    public $vie;
    public $xp;
    public $valeur_pouvoir;
    public $admin;

    public function __construct($p = "",$m = "" , $a = "", $s = "" , $r = "" , $v = "" , $xp = "", $vp = "" , $ad = "") {

        parent::__construct();

        $this->pseudo = $p;
        $this->mot_de_passe = $m;
        $this->age = $a;
        $this->sexe = $s;
        $this->race = $r;
        $this->vie = $v;
        $this->xp = $xp;
        $this->valeur_pouvoir = $vp;
        $this->admin = $ad;

    }
}