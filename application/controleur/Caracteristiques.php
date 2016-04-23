<?php


class Caracteristiques extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function manage(){
        $this->loadModel('CaracteristiqueSQL');
        $model_caracteristique = new CaracteristiqueSQL();
        $this->view->caracteristiques = $model_caracteristique->findAll()->execute();
        
        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        $this->view->categories = $model_categorie->findAll()->execute();

        $this->loadModel('Type_caracteristiqueSQL');
        $model_type_caract = new Type_caracteristiqueSQL();
        $this->view->type_caract = $model_type_caract->findAll()->execute();
        
        $this->view->render('caracteristique/manage');
    }
}