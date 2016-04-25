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

    function add(){

        Auth::isAdmin();

        if(isset($_POST)){

            $this->loadModel('Caracteristique');
            $table_caracteristique = new Caracteristique();
            $table_caracteristique->nom = $_POST['nom'];
            $table_caracteristique->save();

            $this->loadModel('CaracteristiqueSQL');
            $model_caracteristique = new CaracteristiqueSQL();
            $idCaracteristique = $model_caracteristique->maxId()->execute()[0]->maxid;

            $this->loadModel('Type_caracteristique');
            foreach ($_POST['categorie'] as $k=>$c){

                $table_type_Caract = new Type_caracteristique();
                $table_type_Caract->id_caracteristique = $idCaracteristique;
                $table_type_Caract->id_type = $k;
                $table_type_Caract->save();
                
                Session::set('feedback_positive',CARACTERISTIQUE_CREATED);

            }
        }
        
        header('Location: '.URL.'caracteristiques/manage');
        
    }

    function addRelation($idCaracteristique,$idCategorie){
        
        $this->loadModel('Type_caracteristique');
        $type_caract = new Type_caracteristique();
        $type_caract->id_caracteristique = $idCaracteristique;
        $type_caract->id_type = $idCategorie;
        $type_caract->save();
        
        $this->loadModel('Type_caracteristiqueSQL');
        $model_type_caract = new Type_caracteristiqueSQL();

        echo $model_type_caract->maxId()->execute()[0]->maxid;
        
    }
    
    function deleteRelation($id){
        $this->loadModel('Type_caracteristique');
        $type_caract = new Type_caracteristique();
        $type_caract->setId($id);
        $type_caract->delete();
        echo 0;
    }
}