<div class="container">
    <div class="row">

        <?php
        require VIEWS_PATH . '_templates/menu_gauche.php';
        ?>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Toutes les commandes</h1>
                </div>
                <div class="panel-body">
                    <table class="table">
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
                        foreach ($this->commandes as $c):
                            ?>
                            <tr>
                                <td><?=$c->id?></td>
                                <td><?=$this->usersByCommande[$c->id]->nom . " " . $this->usersByCommande[$c->id]->prenom?></td>
                                <td><?=$c->somme?>€</td>
                                <td><?=$c->valide?></td>
                                <td>ANNULÉ / VALIDÉ</td>
                                <td><a href="<?= URL ?>commandes/detail/<?=$c->id?>"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
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