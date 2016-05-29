<?php


class Panier extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){

        Auth::isLog();

        $model_panier = new PanierSQL();
        $idPanier = $model_panier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $model_panier_produit = new Panier_produitSQL();
        $this->view->produits = $model_panier_produit->getProductByIdPanier($idPanier[0]->id);
        
        $this->view->somme = 0;
        foreach($this->view->produits as $p){
            $this->view->somme += $p->prix;
        }

        $model_transport = new TransportSQL();
        $this->view->fdp = $model_transport->fdp($idPanier[0]->id)[0]->total_fdp;

        $this->view->total = $this->view->somme + $this->view->fdp;
        
        $this->view->render('panier/index');

    }

    function addProduit($id,$version){

        Auth::isLog();

        $this->loadModel('Panier_produit');

        $idPanier = new PanierSQL();
        $model_panier = $idPanier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $panier_produit = new Panier_produit();
        $panier_produit->version = $version;
        $panier_produit->id_panier = $model_panier[0]->id;
        $panier_produit->id_produit = $id;

        $panier_produit->save();

        // si c'est une version physique
        if($version ==1 ){

            $this->loadModel('ProduitsSQL');
            $model_produit = new ProduitsSQL();
            $model_produit = $model_produit->findById($id);

            $this->loadModel('Produits');
            $produit = new Produits();
            $produit->setId($id);
            $produit->titre = $model_produit->titre;
            $produit->description = $model_produit->description;
            $produit->stock = $model_produit->stock-1;
            $produit->prix = $model_produit->prix;
            $produit->visible = $model_produit->visible;
            $produit->nouveaute = $model_produit->nouveaute;
            $produit->nb_ventes = $model_produit->nb_ventes+1;
            $produit->id_categorie = $model_produit->id_categorie;
            $produit->save();
        }


        Session::set('feedback_positive', "Vous avez ajouté ce produit à votre panier");
        header('Location: ' . URL . 'produit/index/'.$id);

    }
    
    function delete($ppid){

        $this->loadModel('Panier_produitSQL');
        $model_panier_produit = new Panier_produitSQL();
        $panier_produit = $model_panier_produit->findById($ppid);

        if($panier_produit->version == 1){
            //ajoute +1 au stock du produit supprimé du panier
            $this->loadModel('ProduitsSQL');
            $model_produits = new ProduitsSQL();
            $produit = $model_produits->findById($panier_produit->id_produit);
            $this->loadModel('Produits');
            $table_produit = new Produits();
            $table_produit->setId($produit->id);
            $table_produit->titre = $produit->titre;
            $table_produit->description = $produit->description;
            $table_produit->id_categorie = $produit->id_categorie;
            $table_produit->nb_ventes = $produit->nb_ventes-1;
            $table_produit->nouveaute = $produit->nouveaute;
            $table_produit->prix = $produit->prix;
            $table_produit->stock = $produit->stock+1;
            $table_produit->visible = $produit->visible;
            $table_produit->save();
        }

        $table_panier_produit = new Panier_produit();
        $table_panier_produit->setId($ppid);
        $table_panier_produit->delete();
        
        Session::set('feedback_positive', "Vous avez supprimé l'artcile de votre panier");
        header('Location: ' . URL . "panier/index");
        
    }
    
    public function commander(){

        $this->loadModel('User_adresseSQL');
        $model_adresse = new User_adresseSQL();
        $adresses = $model_adresse->findWithCondition('id_user = :uid' , array(':uid'=>Session::get('user_id')))->execute();

        $model_panier = new PanierSQL();
        $idPanier = $model_panier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $model_panier_produit = new Panier_produitSQL();
        $this->view->produits = $model_panier_produit->getProductByIdPanier($idPanier[0]->id);

        $this->view->somme = 0;
        foreach($this->view->produits as $p){
            $this->view->somme += $p->prix;
        }

        $model_transport = new TransportSQL();
        $this->view->fdp = $model_transport->fdp($idPanier[0]->id)[0]->total_fdp;

        $this->view->total = $this->view->somme + $this->view->fdp;
        
        $this->view->adresses = $adresses;
        
        $this->view->render('panier/commander');
        
    }

    function validerCommande(){

        $model_panier = new PanierSQL();
        $idPanier = $model_panier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $model_panier_produit = new Panier_produitSQL();
        $produits = $model_panier_produit->getProductByIdPanier($idPanier[0]->id);

        $somme = 0;
        foreach($produits as $p){
            $somme += $p->prix;
        }

        $model_transport = new TransportSQL();
        $fdp = $model_transport->fdp($idPanier[0]->id)[0]->total_fdp;

        $total = $somme + $fdp;

        date_default_timezone_set('UTC');

        $this->loadModel('Commande');
        $table_commande = new Commande();
        $table_commande->somme = $total;
        $table_commande->date_commande = date('Y-m-d');
        $table_commande->valide = 0;
        $table_commande->annule = 0;
        $table_commande->id_user = Session::get('user_id');
        $table_commande->save();

        $this->loadModel('Commande_produit');

        $this->loadModel('CommandeSQL');
        $model_commande = new CommandeSQL();
        $idCommande = $model_commande->maxId()->execute()[0]->maxid;

        foreach($produits as $p){
            $table_commande_produit = new Commande_produit();
            $table_commande_produit->id_produit = $p->id;
            $table_commande_produit->id_commande = $idCommande;
            $table_commande_produit->save();
        }

        $this->loadModel('Panier_produit');
        $table_panier_produit = new Panier_produit();
        $table_panier_produit->multiDelete('id_panier = :pid',array(':pid'=>$idPanier[0]->id));

        Session::set('feedback_positive', 'Votre commande à bien été validé, elle est à présent en cours de validation');
        header('Location: ' . URL . 'index');

    }

}