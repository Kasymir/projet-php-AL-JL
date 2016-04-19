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
        $this->loadModel('produitsSQL');
        $model_produits = new produitsSQL();
        $this->view->produits = $model_produits->findAll()->execute();

        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        
        $this->view->categorie = $model_categorie->findAll()->execute();
        $this->view->render('index/index');
    }
}
