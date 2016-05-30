<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Mes commandes en cours</h1>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>somme total</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->commandesEnCours as $c):
                        ?>
                        <tr>
                            <td><?= $c->id ?></td>
                            <td><?= $c->somme ?>€</td>
                            <td><?= $c->valide ?></td>
                            <td><a href="<?= URL ?>commandes/detail/<?= $c->id ?>"><span
                                        class="glyphicon glyphicon-zoom-in"></span></a></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Mes commandes passées validés</h1>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>somme total</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->commandesValide as $c):
                        ?>
                        <tr>
                            <td><?= $c->id ?></td>
                            <td><?= $c->somme ?>€</td>
                            <td><?= $c->valide ?></td>
                            <td><a href="<?= URL ?>commandes/detail/<?= $c->id ?>"><span
                                        class="glyphicon glyphicon-zoom-in"></span></a></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Mes commandes passées annulés</h1>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>somme total</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->commandesAnnule as $c):
                        ?>
                        <tr>
                            <td><?= $c->id ?></td>
                            <td><?= $c->somme ?>€</td>
                            <td><?= $c->valide ?></td>
                            <td><a href="<?= URL ?>commandes/detail/<?= $c->id ?>"><span
                                        class="glyphicon glyphicon-zoom-in"></span></a></td>
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

