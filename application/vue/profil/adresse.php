<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>MES ADRESSES</h1>
            </div>

            <div class="panel-body">
                <?php
                foreach ($this->adresses as $a):
                    ?>
                    <table class="col-md-6">
                        <caption><h4>Adresse de <?= ($a->facturation == 1) ? "facturation" : "livraison" ?></h4>
                        </caption>
                        <tr>
                            <td class="text-right">Adresse :</td>
                            <td style="padding-left:12px;"><?= $a->adresse ?></td>
                        </tr>
                        <tr>
                            <td class="text-right">Code postal :</td>
                            <td style="padding-left:12px;"><?= $a->code_postal ?></td>
                        </tr>
                        <tr>
                            <td class="text-right">Ville :</td>
                            <td style="padding-left:12px;"><?= $a->ville ?></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><a data-toggle="modal"
                                                                   data-target="#AdressUpdate<?= $a->id ?>"
                                                                   class="btn btn-default">Modifier</a></td>
                            <!-- Modal -->
                            <div class="modal fade" id="AdressUpdate<?= $a->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="<?= URL ?>profil/updateAdress/<?= $a->id ?>" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title">Modifier votre addresse
                                                    de <?= ($a->facturation == 1) ? "facturation" : "livraison" ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Adresse :</label>
                                                    <input class="form-control" type="text" name="adresse"
                                                           value="<?= $a->adresse ?>">
                                                    <label>Code postal :</label>
                                                    <input class="form-control" type="text" name="code_postal"
                                                           value="<?= $a->code_postal ?>">
                                                    <label>Ville : </label>
                                                    <input class="form-control" type="text" name="ville"
                                                           value="<?= $a->ville ?>">
                                                    <input type="hidden" name="facturation"
                                                           value="<?= $a->facturation ?>">
                                                    <input type="hidden" name="livraison"
                                                           value="<?= $a->livraison ?>"
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <input class="btn btn-success" type="submit" name="modifier"
                                                       value="Modifier"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </table>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>

