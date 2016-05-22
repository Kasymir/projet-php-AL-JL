<?php


class Commandes extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function mesCommandes(){
        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();

        // commande en cours
        $commandeEnCours = $model_commande->findWithCondition('id_user = :uid and valide = 0 and annule = 0',array(':uid'=>Session::get('user_id')))->execute();

        //commande validé
        $commandeValide = $model_commande->findWithCondition('id_user = :uid and valide = 1 and annule = 0',array(':uid'=>Session::get('user_id')))->execute();

        // commande annulé
        $commandeAnnule = $model_commande->findWithCondition('id_user = :uid and valide = 0 and annule = 1',array(':uid'=>Session::get('user_id')))->execute();
        
        $this->view->commandesEnCours = $commandeEnCours;
        $this->view->commandesValide = $commandeValide;
        $this->view->commandesAnnule = $commandeAnnule;
        
        $this->view->render('profil/mesCommandes');

    }

    function CommandeClient()
    {

        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();
        $this->view->commandes = $model_commande->findAll()->execute();

        $produitByCommande = array();
        $userByCommande = array();


        $this->loadModel('UserSQL');
        $model_user = new UserSQL();
        foreach ($this->view->commandes as $c) {
            $userByCommande[$c->id] = $model_user->findById($c->id_user);
        }
        $this->view->usersByCommande = $userByCommande;

        $this->view->render('commande/commande');

    }

    function detail($cid)
    {

        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();
        $this->view->commande = $model_commande->findById($cid);
        $this->view->produits = $model_commande->produitByCommande($cid);

        $this->loadModel('UserSQL');
        $model_user = new UserSQL();
        $this->view->user = $model_user->findById($this->view->commande->id_user);

        $this->loadModel('User_adresseSQL');
        $model_adresses = new User_adresseSQL();
        $this->view->adresses = $model_adresses->findWithCondition('id_user = :uid' , array(':uid'=>$cid))->execute();

        $this->view->idCommande = $cid;
        
        $this->view->render('commande/detail');

    }

    function valide($cid){

        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();
        $commande = $model_commande->findById($cid);

        $this->loadModel('Commande');
        $table_commande = new Commande();
        $table_commande->setID($cid);
        $table_commande->valide = 1;
        $table_commande->annule = 0;
        $table_commande->somme = $commande->somme;
        $table_commande->id_user = $commande->id_user;
        $table_commande->date_commande = $commande->date_commande;
        $table_commande->save();

        Session::set('feedback_positive', "Vous avez validé la commande");
        header('Location: ' . URL . 'commandes/commandeClient/');

    }

    function annule($cid){

        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();
        $commande = $model_commande->findById($cid);

        $this->loadModel('Commande');
        $table_commande = new Commande();
        $table_commande->setID($cid);
        $table_commande->valide = 0;
        $table_commande->annule = 1;
        $table_commande->somme = $commande->somme;
        $table_commande->id_user = $commande->id_user;
        $table_commande->date_commande = $commande->date_commande;
        $table_commande->save();

        Session::set('feedback_negative', "Vous avez annulé la commande");
        header('Location: ' . URL . 'commandes/commandeClient/');

    }
}