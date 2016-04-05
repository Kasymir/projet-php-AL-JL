<?php


class Produit extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function manage()
    {
        $this->loadModel('ProduitsSQL');
        $model_produits = new ProduitsSQL();
        $this->view->produits = $model_produits->findAll()->execute();

        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        $this->view->categorie = $model_categorie->findAll()->execute();

        $this->loadModel('ImageSQL');
        $model_image = new ImageSQL();
        $this->view->image = $model_image->findAll()->execute();

        $this->view->render('produit/manage');

    }

    function getCaracteristique($idCategorie)
    {
        $this->loadModel('Type_caracteristiqueSQL');
        $this->loadModel('CaracteristiqueSQL');

        $model_Type_Caracteristique = new Type_caracteristiqueSQL();
        $type_caracteristique = $model_Type_Caracteristique->findWithCondition('id_type = :idt', array(':idt' => $idCategorie))->execute();

        $model_Caracteristique = new CaracteristiqueSQL();

        $html = "";
        foreach ($type_caracteristique as $tc) {
            $caracteristique = $model_Caracteristique->findById($tc->id_caracteristique);
            $html .= "<input type='text' name='caracteristique[" . $caracteristique->id . "]'  class='form-control' placeholder='" . $caracteristique->nom . "'/> ";
        }
        echo $html;
    }

    function add()
    {

        Auth::isAdmin();

        if (isset($_POST['ajouter'])) {
            if (
                !empty($_POST['titre']) &&
                !empty($_POST['description']) &&
                !empty($_POST['prix']) &&
                !empty($_POST['stock']) &&
                !empty($_POST['caracteristique'])
            ) {

                $this->loadModel('CategorieSQL');
                $model_categorie = new CategorieSQL();
                $categorie = $model_categorie->findById($_POST['categorie']);

                $nom = md5(uniqid(rand(), true));

                $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
                $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));

                if (in_array($extension_upload, $extensions_valides)) {

                    $path = 'public/images/' . $categorie->nom;
                    
                    if(!is_dir($path))
                        mkdir($path, 0777,true);

                    $nom = "{$path}/{$nom}.{$extension_upload}";
                    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);

                    date_default_timezone_set('UTC');

                    $this->loadModel('Produits');
                    $table_produits = new Produits($_POST['titre'], $_POST['description'], $_POST['prix'], 1, date("Y-m-d"), 0, $_POST['stock'], $_POST['categorie']);
                    $table_produits->save();

                    $this->loadModel('ProduitsSQL');
                    $model_produit = new ProduitsSQL();

                    $this->loadModel('Image');
                    $table_image = new Image($path,1,$model_produit->maxId()->execute()[0]->maxid);
                    $table_image->save();

                    $this->loadModel('Composer');
                    foreach ($_POST['caracteristique'] as $k => $v) {
                        $table_composer = new Composer($model_produit->maxId()->execute()[0]->maxid, $k, $v);
                        $table_composer->save();
                    }

                    Session::set('feedback_positive', PRODUCT_CREATED);
                } else {
                    Session::set('feedback_negative', EXTENSION_FALSE);
                }
            }else{
                Session::set('feedback_negative',EMPTY_FIELD);
            }
        }

        header('location: ' . URL . 'produit/manage');

    }

    function delete()
    {

    }
}
