<?php


class Commentaires extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function ajouterCommentaire($id){
        $this->loadModel('Avis');
        $table_avis = new Avis();
        $table_avis->id_user = Session::get('user_id');
        $table_avis->commentaire = $_POST['avis'];
        $table_avis->id_produit = $id;
        $table_avis->note = $_POST['range'];
        $table_avis->save();

        header('Location: ' . URL . 'produit/index/' . $id);
    }

    function delete($id,$pid){

        $this->loadModel('Avis');
        $table_commentaire = new Avis();

        $table_commentaire->setId($id);
        $table_commentaire->delete();

        Session::set('feedback_positive', "Le commentaire à été supprimé");
        header('Location: ' . URL . 'produit/index/' . $pid);

    }
}