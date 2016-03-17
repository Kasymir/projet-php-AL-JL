<?php

class Pouvoir extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->loadModel('Joueur_pouvoirSQL');
        $model = new Joueur_pouvoirSQL();

        $this->view->pouvoir = $model->findAll()->execute();

        $this->view->render('pouvoir/index');
    }

    function ajouter(){

        Auth::handleLogin();
        if(isset($_POST['add'])){

            $this->loadModel('Joueur_pouvoirSQL');
            $model = new Joueur_pouvoirSQL();

            if($model->findWithCondition('nom = :nom', array(':nom'=>$_POST['nom']))->rowCount()==0){
                $nom = $_POST['nom'];
                $description = $_POST['description'];

                $this->loadModel('Joueur_pouvoir');
                $table = new Joueur_pouvoir($nom,$description);
                $table->save();

                SESSION::set('feedback_positive',POUVOIR_CREATED);
                header('Location: ' . URL . 'pouvoir/gestionPouvoir');
            }else{
                SESSION::set('feedback_negative',POUVOIR_ALREADY_CREATED);
                header('Location: ' . URL . 'pouvoir/gestionPouvoir');
            }


        }else{
            header('Location: ' . URL . 'pouvoir/gestionPouvoir');
        }
    }

    function gestionPouvoir(){

        Auth::handleLogin();
        $this->loadModel('Joueur_pouvoirSQL');
        $model = new Joueur_pouvoirSQL();

        $this->view->pouvoir = $model->findAll()->execute();

        $this->view->render('pouvoir/manage');
    }

    function delete($id){

        Auth::handleLogin();
        $this->loadModel('Joueur_raceSQL');
        $model_race = new Joueur_raceSQL();

        if($model_race->findWithCondition('id_pouvoir = :idp',array(':idp'=>$id))->rowCount()==0){

            $this->loadModel('Joueur_pouvoir');
            $model_pouvoir = new Joueur_pouvoir();
            $model_pouvoir->setId($id);
            $model_pouvoir->delete();
            SESSION::set('feedback_positive',POWER_DELETE);
            header('Location: ' . URL . "pouvoir/gestionPouvoir");

        }else{
            SESSION::set('feedback_negative',POWER_USED);
            header('Location: ' . URL . 'pouvoir/gestionPouvoir');
        }
    }

    function update($id){

        Auth::handleLogin();
        if(isset($_POST)){
            if(!empty($_POST['nom']) && !empty($_POST['description'])){
                $this->loadModel('Joueur_pouvoir');
                $model_pouvoir = new Joueur_pouvoir($_POST['nom'],$_POST['description']);
                $model_pouvoir->setId($id);
                $model_pouvoir->save();
                SESSION::set('feedback_positive',POWER_UPDATE);
                header('Location:' . URL . "pouvoir/gestionPouvoir");
            }else{SESSION::set('feedback_negative',EMPTY_FIELD);
                header('Location: ' . URL . 'pouvoir/gestionPouvoir');
            }
        }else{
            header('Location: ' . URL . 'pouvoir/gestionPouvoir');
        }
    }
}
