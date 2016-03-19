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
            $this->loadModel('UserSQL');
            $model = new UserSQL();

            // load Variable
            $email = $_POST['email'];
            $password = $_POST['password'];

            //check if pseudo exist
            if ($model->findWithCondition("email = :e", array(':e' => $email))->rowCount() == 1) {
                //check if correct password
                if (password_verify($password, $model->findWithCondition("email = :e", array(':e' => $email))->execute()[0]->mdp)) {
                    //SET SESSION
                    SESSION::set('user_name', $model->findWithCondition("email = :e", array(':e' => $email))->execute()[0]->prenom);
                    SESSION::set('user_id', $model->findWithCondition("email = :e", array(':e' => $email))->execute()[0]->id);
                    SESSION::set('feedback_positive', USER_LOGIN);

                    // set session admin if its me
                    if ($model->findWithCondition("email = :e", array(':e' => $email))->execute()[0]->admin > 0)
                        SESSION::set('user_admin', 1);
                    //redirection
                    header('Location: ' . URL . 'index/index');
                } else {
                    SESSION::set('feedback_negative', USER_LOGIN_FAILED_PASSWORD);
                    $this->view->render('login/index');
                }
            } else {
                SESSION::set('feedback_negative', USER_LOGIN_FAILED_EMAIL);
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
                $model_userSQL = new UserSQL();

                if ($model_userSQL->findWithCondition('email = :e', array(':e' => $_POST['email']))->rowCount() == 0) {

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

                        $model_user = new User($sexe, $nom, $prenom, $email, $mdp, 0);
                        $model_user->save();

                        $model_userSQL->findAll()->orderBy('id', "DESC")->limit(0, 1)->execute();

                        $this->loadModel("User_adresse");
                        $model_user_adresse = new User_adresse($adresse, $code_postal, $ville, 1, 1, $model_userSQL->findAll()->orderBy('id', "DESC")->limit(0, 1)->execute()[0]->id);
                        $model_user_adresse->save();

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

        $this->loadModel("UserSQL");
        $model_user = new UserSQL();
        $this->loadModel("user_adresseSQL");
        $model_user_adresse = new user_adresseSQL();

        $this->view->infoUser = $model_user->findById(SESSION::get('user_id'));
        $this->view->infoAdresse = $model_user_adresse ->findWithCondition('id_user = :idu' , array(':idu' => SESSION::get('user_id')))->execute();

        $this->view->render('login/profil');

    }

    function update()
    {
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

        }
    }

    function logout()
    {
        session_destroy();
        header('Location: ' . URL . 'index');
    }
}
