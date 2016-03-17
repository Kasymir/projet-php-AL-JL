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
            if ($model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->rowCount() == 1) {
                //check if correct password
                if (password_verify($password, $model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->mot_de_passe)) {
                    //SET SESSION
                    SESSION::set('user_name', $pseudo);
                    SESSION::set('user_id', $model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->id);
                    SESSION::set('feedback_positive', USER_LOGIN);

                    // set session admin if its me
                    if ($model->findWithCondition("pseudo = :p", array(':p' => $pseudo))->execute()[0]->admin > 0)
                        SESSION::set('user_admin', 1);
                    //redirection
                    header('Location: ' . URL . 'index/index');
                } else {
                    SESSION::set('feedback_negative', USER_LOGIN_FAILED_PASSWORD);
                    $this->view->render('login/index');
                }
            } else {
                SESSION::set('feedback_negative', USER_LOGIN_FAILED_PSEUDO);
                $this->view->render('login/index');
            }

        } else {
            if (SESSION::get('user_id')) {
                header('Location: ' . URL . 'index/');
            } else {
                // If is not logged
                $this->view->render('login/index');
            }
        }

    }

    function register()
    {

        if (isset($_POST['register'])) {

            if (!empty($_POST['nom']) &&
                !empty($_POST['prenom']) &&
                !empty($_POST['email']) &&
                !empty($_POST['password']) &&
                !empty($_POST['password_verify']) &&
                !empty($_POST['adresse']) &&
                !empty($_POST['code_postal']) &&
                !empty($_POST['ville'])
            ) {

                $this->loadModel("UserSQL");
                $model_user = new UserSQL();

                if ($model_user->findWithCondition('email = :e', array(':e' => $_POST['email']))->rowCount() == 0) {

                    if ($_POST['password'] == $_POST['password_verify']) {

                        $this->loadModel("User");

                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $email = $_POST['email'];
                        $mdp = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $sexe = $_POST['civilite'];
                        $adresse = $_POST['adresse'];
                        $code_postal = $_POST['code_postal'];
                        $ville = $_POST['ville'];
                        $admin = 0;

                        $model_user = new User($sexe, $nom, $prenom, $email, $mdp,$adresse,$code_postal,$ville,$admin);
                        $model_user->save();

                        SESSION::set('feedback_positive', USER_CREATED);
                        header('Location: ' . URL . 'login/index');

                    } else {
                        $this->view->post = $_POST;
                        SESSION::set('feedback_negative', REGISTER_FAILED_PASSWORD);
                        $this->view->render('login/inscription');

                    }
                } else {
                    SESSION::set('feedback_negative', ALREADY_EXIST);
                    $this->view->render('login/inscription');
                }

            } else {
                $this->view->post = $_POST;
                SESSION::set('feedback_negative', EMPTY_FIELD);
                $this->view->render('login/inscription');
            }
        } else {
            $this->view->render('login/inscription');
        }
    }

    function monProfil()
    {

        $this->loadModel("JoueurSQL");
        $model_joueur = new JoueurSQL();
        $this->loadModel("Joueur_raceSQL");
        $model_race = new Joueur_raceSQL();

        $this->view->infoJoueur = $model_joueur->findById(SESSION::get('user_id'));
        $this->view->race = $model_race->findAll()->execute();

        if (isset($_POST['update'])) {

            $this->loadModel('Joueur');

            $pseudo = $_POST['pseudo'];
            $mdp = ($_POST['password'] != "") ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $this->view->infoJoueur->mot_de_passe;
            $age = $_POST['age'];
            $sexe = $_POST['sexe'];
            $race = $_POST['race'];
            $vie = $this->view->infoJoueur->vie;
            $xp = $this->view->infoJoueur->xp;
            $valeur_pouvoir = $this->view->infoJoueur->valeur_pouvoir;
            $admin = $this->view->infoJoueur->admin;

            $table = new Joueur($pseudo, $mdp, $age, $sexe, $race, $vie, $xp, $valeur_pouvoir, $admin);
            $table->setId(SESSION::get('user_id'));
            $table->save();

            SESSION::set('feedback_positive', USER_UPDATE);

            header('Location: ' . URL . 'login/monProfil');

        } else {
            $this->view->render('login/profil');
        }
    }

    function logout()
    {
        session_destroy();
        header('Location: ' . URL . 'index');
    }
}
