<?php

class CaracteristiqueSQL extends Query
{
    public function getCaracteristique($idp){
        $sql="
select c.value, cat.nom FROM composer c
 join caracteristique cat on cat.id = c.id_caracteristique
 where c.id_article = :idp
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':idp' => $idp));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }
}

?>