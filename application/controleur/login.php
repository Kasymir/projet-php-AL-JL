<?php


class Login extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function index()
    {

        if (isset($_POST['login'])) {
            // load model
            $this->loadModel('JoueurSQL');
            $model = new JoueurSQL();

            // load Variable
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];

            //check if pseudo exist
            if ( $model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->rowCount() == 1) {
                //check if correct password
                if (password_verify($password, $model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->mot_de_passe)) {
                    //SET SESSION
                    SESSION::set('user_name', $pseudo);
                    SESSION::set('user_id', $model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->id);
                    SESSION::set('feedback_positive', USER_LOGIN);

                    // set session admin if its me
                    if($model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->admin > 0)
                        SESSION::set('user_admin', 1);
                    //redirection
                    header('Location: ' . URL . 'index/index');
                }else{
                    SESSION::set('feedback_negative', USER_LOGIN_FAILED_PASSWORD);
                    $this->view->render('login/index');
                }
            }else{
                SESSION::set('feedback_negative', USER_LOGIN_FAILED_PSEUDO);
                $this->view->render('login/index');
            }

        } else{
            if(SESSION::get('user_id')){
                header('Location: ' . URL . 'index/');
            }else{
                // If is not logged
                $this->view->render('login/index');
            }
        }

    }

    function register()
    {

        $this->loadModel("Joueur_raceSQL");
        $model_race = new Joueur_raceSQL();

        if (isset($_POST['register'])) {

            if(!empty($_POST['pseudo']) &&
                !empty($_POST['password']) &&
                !empty($_POST['password_verify'])
            ) {

                $this->loadModel("JoueurSQL");
                $model_joueur = new JoueurSQL();

                if($model_joueur->findWithCondition('pseudo = :p',array(':p' => $_POST['pseudo']))->rowCount() == 0 ) {

                    if ($_POST['password'] == $_POST['password_verify']) {

                        $this->loadModel("Joueur");

                        $pseudo = $_POST['pseudo'];
                        $mdp = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $age = $_POST['age'];
                        $sexe = $_POST['sexe'];
                        $race = $_POST['race'];
                        $vie = 100;
                        $xp = 0;
                        $valeur_pouvoir = 1;
                        $admin = 0;

                        $model_Joueur = new Joueur($pseudo, $mdp, $age, $sexe, $race, $vie, $xp, $valeur_pouvoir, $admin);
                        $model_Joueur->save();

                        SESSION::set('feedback_positive', USER_CREATED);
                        header('Location: ' . URL . 'login/index');


                    } else {

                        $this->view->post = $_POST;
                        $this->view->race = $model_race->findAll()->execute();
                        SESSION::set('feedback_negative', REGISTER_FAILED_PASSWORD);
                        $this->view->render('login/inscription');

                    }
                }else{
                    $this->view->race = $model_race->findAll()->execute();
                    SESSION::set('feedback_negative',ALREADY_EXIST);
                    $this->view->render('login/inscription');
                }

            }else{

                $this->view->post = $_POST;
                $this->view->race = $model_race->findAll()->execute();
                SESSION::set('feedback_negative',EMPTY_FIELD);
                $this->view->render('login/inscription');

            }

        } else {
            $this->view->race = $model_race->findAll()->execute();
            $this->view->render('login/inscription');
        }
    }

    function monProfil(){

        $this->loadModel("JoueurSQL");
        $model_joueur = new JoueurSQL();
        $this->loadModel("Joueur_raceSQL");
        $model_race = new Joueur_raceSQL();

        $this->view->infoJoueur = $model_joueur->findById(SESSION::get('user_id'));
        $this->view->race = $model_race->findAll()->execute();

        if(isset($_POST['update'])){
            
            $this->loadModel('Joueur');

            $pseudo = $_POST['pseudo'];
            $mdp = ($_POST['password'] != "") ? password_hash($_POST['password'],PASSWORD_BCRYPT) : $this->view->infoJoueur->mot_de_passe;
            $age = $_POST['age'];
            $sexe = $_POST['sexe'];
            $race = $_POST['race'];
            $vie = $this->view->infoJoueur->vie;
            $xp = $this->view->infoJoueur->xp;
            $valeur_pouvoir = $this->view->infoJoueur->valeur_pouvoir;
            $admin = $this->view->infoJoueur->admin;

            $table = new Joueur($pseudo,$mdp,$age,$sexe,$race,$vie,$xp,$valeur_pouvoir,$admin);
            $table->setId(SESSION::get('user_id'));
            $table->save();

            SESSION::set('feedback_positive',USER_UPDATE);

            header('Location: '. URL . 'login/monProfil');
            
        }else{
            $this->view->render('login/profil');
        }
    }

    function logout()
    {
        session_destroy();
        header('Location: ' . URL . 'index');
    }
}
