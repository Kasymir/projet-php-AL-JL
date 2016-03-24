<?php


class Categories extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function manage(){

        Auth::isAdmin();

        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        
        $this->view->categories = $model_categorie->findAll()->execute();
        
        $this->view->render('categories/manage');
        
    }

    function add(){
        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();

        if($model_categorie->findWithCondition('nom = :n', array(':n'=>$_POST['nom']))->rowCount()==0){
            $this->loadModel('Categorie');
            $table_categorie = new Categorie($_POST['nom']);
            $table_categorie->save();

            Session::set('feedback_positive',CATEGORIE_ADD);
            header('Location: ' . URL . 'categories/manage');

        }else{
            Session::set('feedback_negative',CATEGORIE_ALREADY_EXIST);
            header('Location: ' . URL . 'categories/manage');
        }
    }

    function delete($id){

        Auth::isAdmin();

        $this->loadModel('ProduitsSQL');
        $model_produit = new ProduitsSQL();
        
        
        if($model_produit->findWithCondition('id_categorie = :idc' , array(':idc' => $id))->rowCount()==0){
            
            $this->loadModel('Categorie');
            $table_categorie = new Categorie();
            $table_categorie->setId($id);
            $table_categorie->delete($id);

            SESSION::set('feedback_positive',CATEGORY_DELETED);
            header('Location: ' . URL . 'categories/manage');

        }
        else
        {
            SESSION::set('feedback_negative',CATEGORY_USED);
            header('Location: ' . URL . 'categories/manage');
        }
    }

}
