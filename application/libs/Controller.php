<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class Controller
{
    function __construct()
    {
        Session::init();

        require MODELS_PATH . 'autoload.php';


        __autoload("DBAdapter");
        __autoload("Query");
        __autoload("PDODBAdapter");

        __autoload("CRUDAdapter");
        __autoload("Table");
        __autoload("PDOCRUDAdapter");
        
        //inclusion de phpmailer
        include('class.phpmailer.php');

        // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'login/loginWithCookie');
        }

        // create database connection
        try {
            $this->db = new Database();
        } catch (PDOException $e) {
            die('Database connection could not be established.');
        }

        // create a view object (that does nothing, but provides the view render() method)
        $this->view = new View();

        // PANIER HEADER
        
        $this->loadModel('PanierSQL');
        $model_panier = new PanierSQL();
        $idPanier = $model_panier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $this->loadModel('Panier_produitSQL');
        $model_panier_produit = new Panier_produitSQL();
        $this->view->pdts = $model_panier_produit->getProductByIdPanier($idPanier[0]->id);

        $this->view->somme = 0;
        foreach($this->view->pdts as $p){
            $this->view->somme += $p->prix;
        }

        $this->loadModel('TransportSQL');
        $model_transport = new TransportSQL();
        $this->view->fdp = $model_transport->fdp($idPanier[0]->id)[0]->total_fdp;

        $this->view->total = $this->view->somme + $this->view->fdp;

        // END PANIER HEADER
    }

    /**
     * loads the model with the given name.
     * @param $name string name of the model
     */
    public function loadModel($name)
    {
        $path = MODELS_PATH . strtolower($name) . '_model.php';

        if (file_exists($path)) {
            require MODELS_PATH . strtolower($name) . '_model.php';
            // The "Model" has a capital letter as this is the second part of the model class name,
            // all models have names like "LoginModel"
            $modelName = $name . 'Model';
            // return the new model object while passing the database connection to the model
            return new $modelName($this->db);
        } else {
            __autoload($name);
        }
    }
}
