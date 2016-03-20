<?php


class Client extends Controller
{

    function __construct()
    {
        parent::__construct();
    }
    
    function manage(){

        Auth::isAdmin();

        $this->loadModel('UserSQL');
        $model_user = new UserSQL();
        
        $this->view->users = $model_user->findAll()->execute();
        
        $this->view->render('client/tousLesClient');
    }
    
    function delete($id){
        Auth::isAdmin();

        $this->loadModel('User');
        $this->loadModel('User_adresseSQL');

        //Supprime les commandes et les produits associées à l'utilisateur
        $model_commande = new CommandeSQL();
        $commandes = $model_commande->findWithCondition('id_user = :idu' , array(':idu'=>$id));

        foreach ($commandes as $c){
            
        }
        
        //suppression du panier


        // Supprime les adresses associées à l'utilisateur
        $model_adresse = new User_adresseSQL();
        $adresses = $model_adresse->findWithCondition('id_user = :idu' , array(':idu'=>$id));
        $this->loadModel('User_adresse');
        foreach ($adresses as $a){
            $table_adresse = new User_adresse();
            $table_adresse->setId($a->id);
            $table_adresse->delete();
        }

        $model_user = new User();
        $model_user->setId($id);
        $model_user->delete();

        SESSION::set('feedback_positive',USER_DELETED);
        header('Location: ' . URL . 'client/manage');
    }
}
