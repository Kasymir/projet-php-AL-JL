<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_admin.php';
    ?>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>TOUS LES PRODUITS</h1>
            </div>
            <a data-toggle="modal" data-target="#modalAdd" class="pull-right"><i
                    class="fa fa-plus-square-o fa-2"></i></a>
            <div class="panel-body">
                <table class="table tableATrier">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Visible</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->produits as $p):
                        ?>
                        <tr>
                            <td><?= $p->id; ?></td>
                            <td><?= $p->titre ?></td>
                            <td><?= $p->description ?></td>
                            <td><?= $p->prix ?>€</td>
                            <td><?= $p->stock ?></td>
                            <td><?= $p->visible ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <i class="fa fa-angle-double-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" data-toggle="modal" data-target="#modalDelete<?= $p->id ?>"><i
                                                    class="fa fa-trash">
                                                    &nbsp;</i><?= ($p->visible == 1) ? "Désactiver" : "Activer" ?></a>
                                        </li>
                                        <li><a href="<?=URL?>produit/update/<?=$p->id?>"><i
                                                    class="fa fa-pencil">&nbsp;</i>Modifier</a></li>
                                    </ul>
                                </div>
                                <!-- Modal DELETE -->
                                <div class="modal fade" id="modalDelete<?= $p->id ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Supprimer un produit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Voulez-vous vraiment désactiver le produit <?= $p->titre ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Annuler
                                                </button>
                                                <a href="<?= URL ?>produit/delete/<?= $p->id ?>" class="btn btn-danger">Désactiver</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal UPDATE -->
                                <div class="modal fade" id="modalUpdate<?= $p->id ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Modifier le
                                                    produit : <?= $p->titre ?></h4>
                                            </div>
                                            <form method="post" action="<?= URL ?>produit/update/<?= $p->id ?>">
                                                <div class="modal-body">
                                                    <div class="group-img-product">
                                                        
                                                    </div>
                                                    <input class="form-control" type="text" name="titre"
                                                           value="<?= $p->titre ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Annuler
                                                    </button>
                                                    <input class="btn btn-primary" type="submit" name="modifier" value="Modifier">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
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

<!-- Modal ADD -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= URL ?>produit/add" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Ajouter un produit</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                        <select name="categorie" id="categorieProduct" class="form-control">
                            <option value="0">Selection une categorie</option>
                            <?php foreach ($this->categorie as $c) : ?>
                                <option value="<?= $c->id ?>"><?= $c->nom ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="titre" class="form-control" placeholder="Titre">
                        <textarea name="description" placeholder="Description" class="form-control"></textarea>
                        <input type="number" name="prix" min="0" step="any" class="form-control" placeholder="prix">
                        <input type="number" min="0" max="999" name="stock" placeholder="stock" class="form-control">
                        <div id="form-group-categorie"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter">
                </div>
            </div>
        </form>
    </div>
</div>

