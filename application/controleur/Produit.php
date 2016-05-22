<?php


class Produit extends Controller
{

    function __construct()
    {
        parent::__construct();
    }
    
    function index($id){

        $this->loadModel('ProduitsSQL');
        $model_produit = new ProduitsSQL();
        $produit = $model_produit->findById($id);

        if($produit != null && $produit->visible == 1){
            $this->loadModel('ImageSQL');
            $model_image = new ImageSQL();
            $image_main = $model_image->findWithCondition('id_produit = :pid and img_main = 1',array(':pid' => $id))->execute();
            $images = $model_image->findWithCondition('id_produit = :pid and img_main = 0',array(':pid' => $id))->execute();

            $this->loadModel('CaracteristiqueSQL');
            $model_caracteristique = new CaracteristiqueSQL();
            $caracteristiques = $model_caracteristique->getCaracteristique($id);

            $this->loadModel('ExtraitSQL');
            $model_extrait = new ExtraitSQL();
            $extraits = $model_extrait->findWithCondition('id_produit = :idp' , array(':idp'=>$id))->execute();

            $this->loadModel('AvisSQL');
            $model_avis = new AvisSQL();
            $avis = $model_avis->getCommentByProduct($id);

            $this->view->produit = $produit;
            $this->view->image_main = $image_main[0];
            $this->view->images = $images;
            $this->view->caracteristiques = $caracteristiques;
            $this->view->extraits = $extraits;
            $this->view->avis = $avis;

            $this->view->render('produit/index');

        }else{
            header('location: ' . URL . 'error/index');
        }
    }

    function manage()
    {
        
        Auth::isAdmin();
        
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
                        if(mkdir($path)){
                            Session::set('feedback_negative', FAILED_MKDIR);
                            header('location: ' . URL . 'produit/manage');
                        }
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
        $this->loadModel('ExtraitSQL');

        $model_produit = new ProduitsSQL();
        $model_Image = new ImageSQL();
        $model_composer = new ComposerSQL();
        $model_caracteristique = new CaracteristiqueSQL();
        $model_extrait = new ExtraitSQL();

        if(isset($_POST['modifier'])){

            $this->loadModel('Produits');
            $this->loadModel('Image');
            $this->loadModel('Composer');

            // update produit de base
            $model_produit = new ProduitsSQL();
            $produit = $model_produit->findById($id);
            $table_produit = new Produits($_POST['titre'],$_POST['description'],$_POST['prix'],(isset($_POST['visible'])?1:0),$produit->nouveaute,$produit->nb_ventes,$_POST['stock'],$produit->id_categorie);
            $table_produit->setId($id);
            $table_produit->save();


            // update les differentes caracteristiques
            foreach ($_POST['caracteristiques'] as $k=>$c){
                $model_composer = new ComposerSQL();
                $composer = $model_composer->findById($k);
                $table_composer = new Composer($id,$composer->id_caracteristique,$c);
                $table_composer->setId($k);
                $table_composer->save();
            }

            // update images
            foreach ($_FILES as $k=>$i){

                // si integer, je modifie l'image sinon je l'ajoute
                if(is_integer($k)){
                    if(!empty($i['name'])){

                        $nom = md5(uniqid(rand(), true));
                        $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
                        $extension_upload = strtolower(substr(strrchr($_FILES[$k]['name'], '.'), 1));

                        $model_image = new ImageSQL();
                        $image = $model_image->findById($k);

                        if(in_array($extension_upload,$extensions_valides)){
                            $categorie = explode("/",$image->url)[2];
                            $path = "public/images/".$categorie;
                            $nom = $path."/".$nom.".".$extension_upload;
                            $resultat = move_uploaded_file($_FILES[$k]['tmp_name'], $nom);

                            $table_image = new Image($nom,$image->img_main,$image->id_produit);
                            $table_image->setId($k);
                            $table_image->save();

                        }else{
                            Session::set('feedback_negative',EXTENSION_FALSE);
                            header('Location:'.URL.'produit/manage/'.$id);
                        }
                    }
                }
                else{
                    if(!empty($i['name'])){

                        $nom = md5(uniqid(rand(), true));
                        $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
                        $extension_upload = strtolower(substr(strrchr($_FILES[$k]['name'], '.'), 1));

                        $model_image = new ImageSQL();
                        $image = $model_image->findWithCondition('id_produit = :idp and img_main = 1',array(':idp'=>$id))->execute()[0];

                        if(in_array($extension_upload,$extensions_valides)){
                            $categorie = explode("/",$image->url)[2];
                            $path = "public/images/".$categorie;
                            $nom = $path."/".$nom.".".$extension_upload;
                            $resultat = move_uploaded_file($_FILES[$k]['tmp_name'], $nom);

                            $table_image = new Image($nom, 0, $id,$produit->id_categorie);
                            $table_image->save();

                        }else{
                            Session::set('feedback_negative',EXTENSION_FALSE);
                            header('Location:'.URL.'produit/manage/'.$id);
                        }
                    }
                }
            }
            Session::set('feedback_positive',PRODUCT_UPDATE);
            header('Location:'.URL.'produit/manage/'.$id);
        }

        $this->view->produit = $model_produit->findById($id);
        $this->view->images = $model_Image->findWithCondition('id_produit = :idp' , array(':idp'=>$id))->execute();
        $this->view->composer = $model_composer->findWithCondition('id_article = :idp' , array(':idp'=>$id))->execute();
        $this->view->caracteristique = $model_caracteristique->findAll()->execute();
        $this->view->extrait = $model_extrait->findWithCondition('id_produit = :idp' , array(':idp'=>$id))->execute();

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
        
        Auth::isAdmin();
        
        // juste le passer en nom visible pour eviter de les supprimer dans les historiques de commandes
        $this->loadModel('ProduitsSQL');
        $model_produit = new ProduitsSQL();
        $p = $model_produit->findById($id);


        // supprime l'image
        $this->loadModel('ImageSQL');
        $model_image = new ImageSQL();
        $image = $model_image->findWithCondition('id_produit = :idp',array(':idp'=>$id))->execute();

        $this->loadModel('Image');
        foreach ($image as $i){
            $image = new Image();
            $image->setId($i->id);
            $image->delete();
            unlink($i->url);
        }

        // supprime les compositions
        $this->loadModel('ComposerSQL');
        $model_composer = new ComposerSQL();
        $composer = $model_composer->findWithCondition('id_produit = :idp' , array(':idp',array(':idp',$id)));

        $this->loadModel('Composer');
        foreach ($composer as $c){
            $composer = new Composer();
            $composer->setId($c->id);
            $composer->delete();
        }

        // supprime le produit
        $this->loadModel('Produits');
        $table_produit = new Produits($p->titre, $p->description, $p->prix, 0, $p->nouveaute, $p->nb_ventes, $p->stock, $p->id_categorie);
        $table_produit->setId($id);
        $table_produit->delete();

        header('location: ' . URL . 'produit/manage');
    }

    function desactiver($id){

        $this->loadModel('ProduitsSQL');
        $produit = new ProduitsSQL();
        $p = $produit->findById($id);

        $this->loadModel('Produits');
        $produit = new Produits($p->titre,$p->description,$p->prix,$p->visible,$p->nouveaute,$p->nb_ventes,$p->stock,$p->id_categorie);
        $produit->setId($id);

        if($p->visible == 0)
            $produit->visible = 1;
        else
            $produit->visible = 0;
        $produit->save();
        header('Location: '.URL.'produit/manage');
    }


    function addExtrait($id){

        Auth::isAdmin();

        $nom = md5(uniqid(rand(), true));
        $extensions_valides = array('ogg', 'mp3', 'mp4', 'mpeg4', 'wav' , 'flv' , 'wmv' , 'mov', 'wav');
        $extension_upload = strtolower(substr(strrchr($_FILES['extrait']['name'], '.'), 1));

        $this->loadModel('ProduitsSQL');
        $model_produit = new ProduitsSQL();
        $idCategorie = $model_produit->findById($id)->id_categorie;


        $this->loadModel('CategorieSQL');
        $model_categorie = new CategorieSQL();
        $categorie = $model_categorie->findById($idCategorie);

        if(in_array($extension_upload,$extensions_valides)){
            $path = "public/extraits/".$categorie->nom;

            if (!is_dir($path))
                if(mkdir($path)){
                    Session::set('feedback_negative', FAILED_MKDIR);
                    header('location: ' . URL . 'produit/manage');
                }

            $nom = $path."/".$nom.".".$extension_upload;
            $resultat = move_uploaded_file($_FILES['extrait']['tmp_name'], $nom);

            $this->loadModel('Extrait');
            $table_extrait = new Extrait($_POST['titre'],$nom,$_POST['type'],$id);
            $table_extrait->save();

            Session::set('feedback_positive',EXTRAIT_ADD);
            header('Location:'.URL.'produit/manage/'.$id);
        }else{
            Session::set('feedback_negative',EXTENSION_FALSE);
            header('Location:'.URL.'produit/manage/'.$id);
        }
    }

    function deleteExtrait($id){
        
        Auth::isAdmin();

        $this->loadModel('ExtraitSQL');
        $model_extrait = new ExtraitSQL();
        $extrait = $model_extrait->findById($id);

        unlink($extrait->url);

        $this->loadModel('Extrait');
        $table_extrait = new Extrait();
        $table_extrait->setId($id);
        $table_extrait->delete();

        header('Location: '.URL.'produit/manage');
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
