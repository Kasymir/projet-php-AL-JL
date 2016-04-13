<?php


class Profil extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        
        Auth::isLog();

        $this->loadModel("UserSQL");
        $model_user = new UserSQL();
        
        $this->loadModel("user_adresseSQL");
        $model_user_adresse = new user_adresseSQL();

        $this->view->infoUser = $model_user->findById(SESSION::get('user_id'));
        $this->view->infoAdresse = $model_user_adresse ->findWithCondition('id_user = :idu' , array(':idu' => SESSION::get('user_id')))->execute();

        $this->view->render('profil/profil');

    }

    function update($id){

        Auth::isLog();

        $this->loadModel('User');

        $this->loadModel('UserSQL');
        $model_user = new UserSQL();
        $user = $model_user->findById(Session::get('user_id'));
        $table_user = "";

        if(!empty($_POST['password'])){

            if ($_POST['password'] != $_POST['password_verify']) {
                Session::set('feedback_negative',REGISTER_FAILED_PASSWORD);
                header('Location: '.URL.'profil/index');
            }else{
                $table_user = new User($_POST['sexe'],$_POST['nom'],$_POST['prenom'],$user->email,password_hash($_POST['password'], PASSWORD_BCRYPT),$user->token,$user->admin);
            }

        }else{
            $table_user = new User($_POST['sexe'],$_POST['nom'],$_POST['prenom'],$user->email,$user->mdp,$user->token,$user->admin);
        }

        $table_user->setId($id);
        $table_user->save();
        Session::set('feedback_positive',USER_UPDATE);
        header('Location: '.URL.'profil/index');

    }
    
    function adresse(){

        Auth::isLog();
        
        $this->loadModel('User_adresseSQL');
        $model_adresse = new User_adresseSQL();
        
        $this->view->adresses = $model_adresse->findWithCondition('id_user = :idu' , array(':idu' => SESSION::get('user_id')))->execute();
        
        $this->view->render('profil/adresse');
    }

    function updateAdresse($id){

    }
    
    function commandePassees(){

        Auth::isLog();
        
        $this->view->render('profil/commandePassees');
    }
    function commandeEnCours(){

        Auth::isLog();
        
        $this->view->render('profil/commandeEnCours');
    }
}