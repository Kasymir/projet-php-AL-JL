<?php

class CommandeSQL extends Query
{

    function produitByCommande($commande){
        $sql = "
            SELECT p.* from produits p 
            join commande_produit cp on cp.id_produit = p.id
            where cp.id_commande = :c
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':c' => $commande));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }
}

?>