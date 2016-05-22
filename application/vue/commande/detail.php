<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Détail de la commande</h1>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <caption><h4>Produits de la commande</h4>
                                        <thead>
                                        <th>Titre</th>
                                        <th>Prix</th>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <td class="text-right">Somme :</td>
                                            <td><?= $this->commande->somme ?>€</td>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                        foreach ($this->produits as $p):
                                            ?>
                                            <tr>
                                                <td><?= $p->titre ?></td>
                                                <td><?= $p->prix ?>€</td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                        </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <caption><h4>Informations utilisateur</h4>
                                        <thead>
                                        <th>Civilité</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?= ($this->user->civilite == 1) ? "M." : "Mme." ?></td>
                                            <td><?= $this->user->nom ?></td>
                                            <td><?= $this->user->prenom ?></td>
                                            <td><?= $this->user->email ?></td>
                                        </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                foreach ($this->adresses as $a):
                                    ?>
                                    <table class="col-md-6">
                                        <caption><h4>Adresse
                                                de <?= ($a->facturation == 1) ? "facturation" : "livraison" ?></h4>
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
                                    </table>
                                    <?php
                                endforeach;
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php
                    if (Session::get('user_admin')):
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center" style="margin-top:20px">
                                    <a href="<?= URL ?>commandes/valide/<?= $this->idCommande ?>"
                                       class="btn btn-success">VALIDE
                                        COMMANDE</a>
                                    <a href="<?= URL ?>commandes/annule/<?= $this->idCommande ?>"
                                       class="btn btn-danger">ANNULE
                                        COMMANDE</a>
                                </div>
                            </div>
                        </div>

                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
