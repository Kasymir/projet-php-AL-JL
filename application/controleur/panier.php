<?php


class Panier extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function addProduit($id,$version){

        $this->loadModel('PanierSQL');
        $idPanier = new PanierSQL();
        $model_panier = $idPanier->findWithCondition('id_user = :uid',array(':uid'=>Session::get('user_id')))->execute();

        $this->loadModel('Panier_produit');
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
            $produit->nb_ventes = $model_produit->nb_ventes;
            $produit->id_categorie = $model_produit->id_categorie;
            $produit->save();
        }


        Session::set('feedback_positive', "Vous avez ajouté ce produit à votre panier");
        header('Location: ' . URL . 'produit/index/'.$id);

    }

}