<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>TOUTES LES CATEGORIES</h1>
            </div>
            <a data-toggle="modal" data-target="#modalAdd" class="pull-right"><i
                    class="fa fa-plus-square-o fa-2"></i></a>
            <div class="panel-body">
                <!-- Modal ADD -->
                <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <form action="<?= URL ?>categories/add" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Ajouter une catégorie</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nom" placeholder="Nom de la categorie"
                                           class="form-control">

                                    <h4>Caractéristiques associés</h4>
                                    <?php
                                    if (sizeof($this->caracteristique) == 0):
                                        echo "<p>Aucune caractéristique n'a été créée</p>";
                                    else:
                                        ?>
                                        <?php foreach ($this->caracteristique as $c): ?>
                                            <span class="col-md-3">
                                                <input type="checkbox" name="caracteristique[]" value="<?= $c->id ?>"/><?= $c->nom ?>
                                            </span>
                                        <?php
                                    endforeach;
                                        ?>
                                        <?php
                                    endif;
                                    ?>
                                    <div class="form-group" id="caracteristique-categorie">
                                        <input type="text" name="caracteristique[]"
                                               placeholder="caracteristique associé"
                                               class="form-control carac-categorie" id="carac0">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-primary" name="ajouter" value="Ajouter">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    foreach ($this->categories as $c):
                        ?>
                        <tr>
                            <td><?= $c->id; ?></td>
                            <td><?= $c->nom; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <i class="fa fa-angle-double-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" data-toggle="modal" data-target="#modalDelete<?= $c->id ?>"><i
                                                    class="fa fa-trash">&nbsp;</i>Supprimer</a></li>
                                    </ul>
                                </div>
                                <!-- Modal DELETE -->
                                <div class="modal fade" id="modalDelete<?= $c->id ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Supprimer une cat"gorie</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Voulez-vous vraiment supprimer la categorie <?= $c->nom ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Annuler
                                                </button>
                                                <a href="<?= URL ?>categories/delete/<?= $c->id ?>"
                                                   class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    endforeach;;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

