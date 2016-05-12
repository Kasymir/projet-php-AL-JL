<?php

class Panier_produitSQL extends Query
{

    public function getProductByIdPanier($pid){

        $sql = "
            SELECT p.id,p.titre,p.prix,pp.version FROM produits p
            JOIN panier_produit pp on pp.id_produit = p.id
             where pp.id_panier = :pid
        ";

        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':pid'=>$pid));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));

    }
    
    

}

?>