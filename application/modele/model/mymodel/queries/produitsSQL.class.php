<?php

class ProduitsSQL extends Query
{
    public function findProductWithImage()
    {
        $this->dbAdapter->prepare("SELECT * FROM `produits` INNER JOIN `image` ON `produits`.`id`=`image`.`id_produit` AND `image`.`img_main` = 1 and produits.visible=1");
        $this->dbAdapter->execute();
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }

    public function findProductByCategorie($categorie)
    {
        $sql = "
SELECT 
distinct(produits.id) as pid,titre,description,prix,visible,nouveaute,nb_ventes,stock,id_categorie,categorie.nom,categorie.id as cid,image.id as iid,url,img_main,
id_produit
FROM produits 
  join categorie on produits.id_categorie = categorie.id
  join image on image.id_produit = produits.id
  where categorie.nom like :nom and img_main=1 and produits.visible = 1";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':nom' => $categorie));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }


    function meilleuresVentes($c){

        $sql="
        SELECT * FROM produits 
        JOIN categorie c on c.id = produits.id_categorie
        JOIN `image` ON `produits`.`id`=`image`.`id_produit`
        WHERE c.nom like :c and img_main = 1
        ORDER BY nb_ventes
        LIMIT 0,5
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':c' => $c));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));

    }

    function findNewProduct($c){
        $sql="
        SELECT * FROM produits 
        JOIN categorie c on c.id = produits.id_categorie
        JOIN `image` ON `produits`.`id`=`image`.`id_produit`
        WHERE c.nom like :c and img_main = 1
        ORDER BY nouveaute
        LIMIT 0,5
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':c' => $c));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }

}

?>