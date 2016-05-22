<?php

class AvisSQL extends Query
{

    function getCommentByProduct($pid){
        $sql = "
        select a.*,u.prenom,u.nom from avis a
        join user u on u.id = a.id_user
        where a.id_produit = :pid
        ";
        $this->dbAdapter->prepare($sql);
        $this->dbAdapter->execute(array(':pid' => $pid));
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName . 'SQL'));
    }

}

?>