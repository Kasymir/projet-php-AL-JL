<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Mon Panier</h1>
        </div>

        <div class="panel-body">
            <?php
            if (sizeof($this->produits) == 0):
                ?>
                <h3>Vous n'avez rien ajouté dans votre panier</h3>
                <?php
            else :
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <th>Titre</th>
                            <th>Version</th>
                            <th>Action</th>
                            <th>Prix</th>
                            </thead>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">Somme :</td>
                                <td><?= $this->somme ?>€</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Frais de transport :</td>
                                <td><?= ($this->fdp == "") ? "0" : $this->fdp ?>€</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Total :</td>
                                <td><?= $this->total ?>€</td>
                            </tr>
                            <tr>
                                <td colspan="4"><a href="<?=URL?>panier/commander" class="btn btn-success pull-right">COMMANDER</a></td>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            foreach ($this->produits as $p):
                                ?>
                                <tr>
                                    <td><?= $p->titre ?></td>
                                    <td><?= ($p->version == 1) ? 'Version physique' : 'version numérique' ?></td>
                                    <td><a href="<?= URL ?>panier/delete/<?= $p->id_panier_produit ?>"
                                           class="btn btn-danger">RETIRER</a>
                                    </td>
                                    <td><?= $p->prix ?>€</td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</div>
