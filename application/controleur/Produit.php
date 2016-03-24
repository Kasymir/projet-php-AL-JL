<?php


class Produit extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function manage()
    {
        $this->loadModel('ProduitsSQL');
        $model_produits = new ProduitsSQL();
        $this->view->produits = $model_produits->findAll()->execute();
        
        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        $this->view->categorie = $model_categorie->findAll()->execute();
        
        $this->view->render('produit/manage');

    }

    function add(){

    }

    function delete(){
        
    }
}
