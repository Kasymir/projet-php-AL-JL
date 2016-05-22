<div class="col-md-3 col-xs-12">
    <div class="btn-group-vertical col-md-12" role="group">
        <a class="btn btn-default" href="<?= URL ?>profil/index">Mon Profil</a>
        <a class="btn btn-default" href="<?= URL ?>profil/adresse">Mes adresses</a>
        <a class="btn btn-default" href="<?= URL ?>commandes/mesCommandes">Mes commandes</a>
    </div>

    <?php
    if (Session::get('user_admin')):
    ?>
    <div class="btn-group-vertical col-md-12" role="group" style="margin-top:5px;">
        <a class="btn btn-default" href="<?= URL ?>client/manage">Gestion clients</a>
        <a class="btn btn-default" href="<?= URL ?>commandes/commandeClient">Gestion des commandes</a>
        <a class="btn btn-default" href="<?= URL ?>produit/manage">Gestion des produits</a>
        <a class="btn btn-default" href="<?= URL ?>categories/manage">Gestion des catégories</a>
        <a class="btn btn-default" href="<?= URL ?>caracteristiques/manage">Gestion des caracteristiques</a>
    </div>
<?php
endif;
?>
</div>
