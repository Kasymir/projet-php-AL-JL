<?php

class ProduitsSQL extends Query
{
public function findProductWithImage(){
        $this->dbAdapter->prepare("SELECT * FROM `produits` INNER JOIN `image` ON `produits`.`id`=`image`.`id_produit` AND `image`.`img_main` = 1");
        $this->dbAdapter->execute();
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName.'SQL'));
    }
}

?>