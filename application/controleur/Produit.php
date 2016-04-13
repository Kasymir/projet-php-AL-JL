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

                    if (!is_dir($path))
                        mkdir($path, 1755, true);

                    $nom = "{$path}/{$nom}.{$extension_upload}";
                    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);

                    date_default_timezone_set('UTC');

                    $this->loadModel('Produits');
                    $table_produits = new Produits($_POST['titre'], $_POST['description'], $_POST['prix'], 1, date("Y-m-d"), 0, $_POST['stock'], $_POST['categorie']);
                    $table_produits->save();

                    $this->loadModel('ProduitsSQL');
                    $model_produit = new ProduitsSQL();

                    $this->loadModel('Image');
                    $table_image = new Image($nom, 1, $model_produit->maxId()->execute()[0]->maxid);
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
            } else {
                Session::set('feedback_negative', EMPTY_FIELD);
            }
        }

        header('location: ' . URL . 'produit/manage');
    }

    function update($id){

        Auth::isAdmin();

        $this->loadModel('ProduitsSQL');
        $this->loadModel('ImageSQL');
        $this->loadModel('ComposerSQL');
        $this->loadModel('CaracteristiqueSQL');

        $model_produit = new ProduitsSQL();
        $model_Image = new ImageSQL();
        $model_composer = new ComposerSQL();
        $model_caracteristique = new CaracteristiqueSQL();

        $this->view->produit = $model_produit->findById($id);
        $this->view->images = $model_Image->findWithCondition('id_produit = :idp' , array(':idp'=>$id))->execute();
        $this->view->composer = $model_composer->findWithCondition('id_article = :idp' , array(':idp'=>$id))->execute();
        $this->view->caracteristique = $model_caracteristique->findAll()->execute();

        $allIdcaracteristique = array();

        foreach ($this->view->composer as $k=>$c){
            $allIdcaracteristique[] = $c->id_caracteristique;
            $allcaracteristique[$c->id_caracteristique] = $c->value;
        }

        foreach ($this->view->caracteristique as $c){
            if(in_array($c->id,$allIdcaracteristique)){
                $this->view->allCaracteristique[$c->nom] = array($allcaracteristique[$c->id],$c->id);
            }
        }

        $this->view->render('produit/update');

    }

    function delete($id)
    {
        // juste le passer en nom visible pour eviter de les supprimer dans les historiques de commandes

        $this->loadModel('ProduitsSQL');
        $model_produit = new ProduitsSQL();
        $p = $model_produit->findById($id);

        $this->loadModel('Produits');
        $table_produit = new Produits($p->titre, $p->description, $p->prix, 0, $p->nouveaute, $p->nb_ventes, $p->stock, $p->id_categorie);
        $table_produit->setId($id);
        $table_produit->save();
    }


    /*
     * Fonction AJAX
     */

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

    function getImage($idp)
    {

        $this->loadModel('ImageSQL');
        $model_image = new ImageSQL();
        $image_main = $model_image->findWithCondition('id_produit = :idp and img_main = :imgm', array(':idp' => $idp, ':imgm' => 1))->execute()[0];
        $images = $model_image->findWithCondition('id_produit = :idp and img_main = :imgm', array(':idp' => $idp, ':imgm' => 0))->execute();

        $html = "<div class='row'>";

        $html .= "<img class='col-md-4' src='" . URL . $image_main->url . "' />";

        for ($tmp = 0; $tmp < 2; $tmp++):
            if (isset($images[$tmp])):
                $html .= "<img class='col-md-4' src='" . URL . $images[$tmp]->url . "' />";
            else:
                $html .= "<img class='col-md-4' src='" . URL . "public/images/jesuisabsente.png' />";
            endif;
        endfor;


        $html .= "</div>";

        echo $html;

    }
}
