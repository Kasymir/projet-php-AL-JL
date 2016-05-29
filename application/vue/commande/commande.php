<div class="container">
    <div class="row">

        <?php
        require VIEWS_PATH . '_templates/menu_gauche.php';
        ?>
        <div class="col-md-9">

            <!-- COMMANDE EN ATTENTES -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Commandes en attentes</h1>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom client</th>
                            <th>somme total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->commandes_en_cours as $cec):
                            ?>
                            <tr>
                                <td><?=$cec->id?></td>
                                <td><?=$cec->nom . " " . $cec->prenom?></td>
                                <td><?=$cec->somme?>€</td>
                                <td><a href="<?= URL ?>commandes/detail/<?=$cec->id?>"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- COMMANDES OK -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Toutes les commandes</h1>
                </div>
                <div class="panel-body">
                    <table class="table tableATrier">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom client</th>
                            <th>somme total</th>
                            <th>Valide</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->commandes_ok as $co):
                            ?>
                            <tr>
                                <td><?=$co->id?></td>
                                <td><?=$co->nom . " " . $co->prenom?></td>
                                <td><?=$co->somme?>€</td>
                                <td><?=(($co->valide)?"<i class='glyphicon glyphicon-ok' content='v'></i>":"<i class='glyphicon glyphicon-remove' content='x'></i>")?></td>
                                <td>ANNULÉ / VALIDÉ</td>
                                <td><a href="<?= URL ?>commandes/detail/<?=$co->id_commande?>"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>