<?php


class Profil extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){

        $this->loadModel("UserSQL");
        $model_user = new UserSQL();
        
        $this->loadModel("user_adresseSQL");
        $model_user_adresse = new user_adresseSQL();

        $this->view->infoUser = $model_user->findById(SESSION::get('user_id'));
        $this->view->infoAdresse = $model_user_adresse ->findWithCondition('id_user = :idu' , array(':idu' => SESSION::get('user_id')))->execute();

        $this->view->render('profil/profil');

    }
    
    function adresse(){
        
        $this->loadModel('User_adresseSQL');
        $model_adresse = new User_adresseSQL();
        
        $this->view->adresses = $model_adresse->findWithCondition('id_user = :idu' , array(':idu' => SESSION::get('user_id')));
        
        $this->view->render('profil/adresse');
    }
    
    function commandePassees(){
        $this->view->render('profil/commandePassees');
    }
    function commandeEnCours(){
        $this->view->render('profil/commandeEnCours');
    }
}