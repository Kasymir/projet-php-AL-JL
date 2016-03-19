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

    function updateProfil(){

    }
    function commandePassee(){

    }
    function commandeEnCours(){

    }
}