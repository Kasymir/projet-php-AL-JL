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

        if($id != Session::get('user_id')){
            $this->loadModel('User');
            $this->loadModel('User_adresseSQL');

            //Supprime les commandes et les produits associées à l'utilisateur
            $this->loadModel('CommandeSQL');
            $model_commande = new CommandeSQL();$nbcommandes = $model_commande->findWithCondition('id_user = :idu' , array(':idu'=>$id))->rowCount();
            $commandes = $model_commande->findWithCondition('id_user = :idu' , array(':idu'=>$id));

            if($commandes->rowCount() > 0){
                foreach ($commandes->execute() as $c){
                    $this->loadModel('Commande_produit');
                    $table_commande_produit = new Commande_produit();
                    $table_commande_produit->multiDelete('id_commande = :idc',array(':idc' => $c->id));
                }

                //supprime commande_produit
                $this->loadModel('Commande');
                $table_commande = new Commande();
                $table_commande->multiDelete('id_user = :idu',array(':idu' => $id));
            }

            //supprime panier_produit
            $this->loadModel('PanierSQL');
            $model_panier = new PanierSQL();
            $panier = $model_panier->findWithCondition('id_user = :idu',array(':idu'=>$id));

            if($panier->rowCount()>0) {

                $this->loadModel('Panier_produitSQL');
                $model_panier_produit = new Panier_produitSQL();

                $panier_produit = $model_panier_produit->findWithCondition('id_panier = :idp' , array(':idp'=>$panier->execute()[0]->id));

                if($panier_produit->rowCount()>0){
                    $this->loadModel('Panier_produit');
                    $table_panier_produit = new Panier_produit();
                    $table_panier_produit->multiDelete('id_panier = :idp', array(':idp', $panier->execute()[0]->id));
                }
            }

            //suppression du panier
            $this->loadModel('Panier');
            $table_panier = new Panier();
            $table_panier->multiDelete('id_user = :idu',array(':idu'=>$id));


            //supprime les avis
            $this->loadModel('Avis');
            $table_avis = new Avis();
            $table_avis->multiDelete('id_user = :idu',array(':idu' => $id));


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
        }else{
            SESSION::set('feedback_negative',USER_DELETE_HIMSELF);
            header('Location: ' . URL . 'client/manage');
        }
    }

    function update($id){

        Auth::isAdmin();

        if($id != Session::get('user_id')){

            $this->loadModel('UserSQL');
            $model_client = new UserSQL();
            $client = $model_client->findById($id);

            $this->loadModel('User');
            $table_client = new User($client->civilite,$client->nom,$client->prenom,$client->email,$client->mdp,(($client->admin==0)?1:0));
            $table_client->setId($id);

            Session::set('feedback_positive',USER_UPDATE);
            header('Location:' . URL . 'client/manage');

        }else{

            Session::set('feedback_negative',USER_UPDATE_HIMSELF);
            header('Location:' . URL . 'client/manage');

        }
    }
}
