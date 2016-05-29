<?php

class CommandeSQL extends Query
{

    function produitByCommande($commande)
    {
        $sql = "
            SELECT p.* from produits p 
            join commande_produit cp on cp.id_produit = p.id
            where cp.id_commande = :c
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':c' => $commande));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }

    function commandeEnCours()
    {
        $sql = "
            select commande.id, commande.somme,commande.valide,commande.annule,commande.id_user,user.nom,user.prenom from commande
join user on user.id = commande.id_user where annule = 0 and valide = 0
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute();
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }

    function commandeOk()
    {
        $sql = "
            select commande.id, commande.somme,commande.valide,commande.annule,commande.id_user,user.nom,user.prenom from commande
join user on user.id = commande.id_user where annule = 1 or valide = 1
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute();
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }
}

?>