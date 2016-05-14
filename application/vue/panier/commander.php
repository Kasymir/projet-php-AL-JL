<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Commander</h1>
                </div>
                <div class="panel-body">
                    <h3>Mes adresses</h3>
                    <?php
                    foreach ($this->adresses as $a):
                        ?>
                        <table class="col-md-6">
                            <caption><h4>Adresse de <?= ($a->facturation == 1) ? "facturation" : "livraison" ?></h4></caption>

                            <tbody>
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
                            </tbody>
                        </table>
                        <?php
                    endforeach;
                    ?>
                    <a href="<?=URL?>profil/adresse">Modifier mes adresses</a>

                    <h3>Contenu de mon panier</h3>
                    <table class="table">
                        <thead>
                        <th>Titre</th>
                        <th>Version</th>
                        <th>Prix</th>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="2" class="text-right">Somme :</td>
                            <td><?= $this->somme ?>€</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Frais de transport :</td>
                            <td><?= ($this->fdp == "") ? "0" : $this->fdp ?>€</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Total :</td>
                            <td><?= $this->total ?>€</td>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        foreach ($this->produits as $p):
                            ?>
                            <tr>
                                <td><?= $p->titre ?></td>
                                <td><?= ($p->version == 1) ? 'Version physique' : 'version numérique' ?></td>
                                <td><?= $p->prix ?>€</td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <a href="<?=URL?>panier/">Modifier mon panier</a>

                    <h4>Montant à règler : <?=$this->total?>€</h4>

                    <a href="<?=URL?>panier/validerCommande" class="btn btn-success pull-right">Valider ma commande</a>

                </div>
            </div>
        </div>
    </div>
</div>