<div class="container">

    <div class="col-md-3 col-xs-12">
        <div class="btn-group-vertical col-md-12" role="group">
            <a class="btn btn-default" href="<?= URL ?>profil/index">Mon Profil</a>
            <a class="btn btn-default" href="<?= URL ?>profil/adresse">Mes adresses</a>
            <a class="btn btn-default" href="<?= URL ?>profil/commandePassees">Mes commandes passées</a>
            <a class="btn btn-default" href="<?= URL ?>profil/commandeEnCours">Mes commandes en cours</a>
        </div>
    </div>
    <div class="col-md-9">
        <form class="form-signin" role="form" action="<?php echo URL; ?>login/update/<?= $this->adresses->id ?>"
              method="post">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>MES ADRESSES</h1>
                </div>

                <div class="panel-body">
                    <?php
                    foreach ($this->adresses as $a):
                        ?>
                        <table class="col-md-6">
                            <caption><h4>Adresse de <?= ($a->facturation == 1) ? "facturation" : "livraison" ?></h4></caption>
                            <tr>
                                <td class="text-right">Adresse :</td>
                                <td style="padding-left:12px;"><?= $a->adresse ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Code postal :</td>
                                <td  style="padding-left:12px;"><?= $a->code_postal ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Ville :</td>
                                <td  style="padding-left:12px;"><?= $a->ville ?></td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2"><a class="btn btn-default">Modifier</a></td>
                            </tr>
                        </table>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>

