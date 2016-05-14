<?php

class CaracteristiqueSQL extends Query
{
    public function getCaracteristique($idp){
        $sql="
        select produits.id,caracteristique.nom,composer.value from categorie
join type_caracteristique tc on tc.id_type = categorie.id
join caracteristique on caracteristique.id = tc.id_caracteristique
join composer on composer.id_caracteristique = caracteristique.id
join produits on produits.id = composer.id_article
where produits.id = :idp
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':idp' => $idp));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }
}

?>