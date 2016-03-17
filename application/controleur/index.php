<?php

/**
 * Class Index
 * The index controller
 */
class Index extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index()
    {

        $this->loadModel('Avis');
        $model_avis = new Avis();
        $this->loadModel('Caracteristique');
        $model_caracteristique = new Caracteristique();
        $this->loadModel('Categorie');
        $model_categories = new Categorie();
        $this->loadModel('Commande_produit');
        $model_commande_produit = new Commande_produit();
        $this->loadModel('Commande');
        $model_commande = new Commande();
        $this->loadModel('Panier_produit');
        $model_panier_produit = new Panier_produit();
        $this->loadModel('Panier');
        $model_panier = new Panier();
        $this->loadModel('Produits');
        $model_produits = new Produits();
        $this->loadModel('Transport');
        $model_transport = new Transport();
        $this->loadModel('User');
        $model_user = new User();

        $this->view->render('index/index');
    }
}
