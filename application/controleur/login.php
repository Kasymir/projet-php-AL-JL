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
        if (Session::get('user_id') == null ) {

            if (isset($_POST['register'])) {

                if (!empty($_POST['nom']) &&
                    !empty($_POST['prenom']) &&
                    !empty($_POST['email']) &&
                    !empty($_POST['password']) &&
                    !empty($_POST['password_verify']) &&
                    !empty($_POST['adresse_l']) &&
                    !empty($_POST['code_postal_l']) &&
                    !empty($_POST['ville_l']) &&
                    !empty($_POST['adresse_f']) &&
                    !empty($_POST['code_postal_f']) &&
                    !empty($_POST['ville_f'])
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

                            //Adresse de livraison
                            $adresse_l = $_POST['adresse_l'];
                            $code_postal_l = $_POST['code_postal_l'];
                            $ville_l = $_POST['ville_l'];

                            //adresse de facturation
                            $adresse_f = $_POST['adresse_f'];
                            $code_postal_f = $_POST['code_postal_f'];
                            $ville_f = $_POST['ville_f'];

                            $model_user = new User($sexe, $nom, $prenom, $email, $mdp, 0, 0);
                            $model_user->save();

                            // Prend le dernier id ajouté a la BD
                            $id_user = $model_userSQL->lastInsertId();

                            $this->loadModel("User_adresse");

                            //sauvegarde adresse de livraison
                            $model_user_adresse = new User_adresse($adresse_l, $code_postal_l, $ville_l, 0, 1, $id_user);
                            $model_user_adresse->save();

                            //sauvegarde adresse de facturation
                            $model_user_adresse = new User_adresse($adresse_f, $code_postal_f, $ville_f, 1, 0, $id_user);
                            $model_user_adresse->save();

                            //on lui associe un nouveau panier vide
                            $this->loadModel('Panier');
                            $model_panier = new Panier($id_user);
                            $model_panier->save();


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
        }else{
            header('Location: ' . URL . 'login/index');
        }
    }

    function logout()
    {

        Auth::isLog();

        session_destroy();
        header('Location: ' . URL . 'index');
    }
}
