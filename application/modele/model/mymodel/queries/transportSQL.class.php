<?php

class TransportSQL extends Query
{
    public function fdp($pid)
    {
        $sql ="
        select sum(t.prix) as total_fdp from transport t 
        join produits p on p.id_Categorie = t.id_categorie 
        join panier_produit pp on pp.id_produit = p.id 
        where pp.id_panier = :pid and version = 1;
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':pid' => $pid));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));

    }
}

?>