<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="tables">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            gestion des pouvoirs
                        </div>
                        <div class="text-right col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modalAdd">
                                <i class="fa fa-plus-square-o fa-2" style="color: white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Modal Add -->
                <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="<?= URL ?>pouvoir/ajouter" method="post">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="myModalLabel">AJOUTER UN POUVOIR</h2>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="nom"
                                                   placeholder="Nom du pouvoir">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="description" rows="5"
                                                      placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer
                                    </button>
                                    <input type="submit" class="btn btn-primary" name="add" value="Ajouter">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->pouvoir as $p):
                            ?>
                            <tr>
                                <td><?= $p->id; ?></td>
                                <td><?= $p->nom; ?></td>
                                <td><?= $p->description; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Action <span class="fa fa-angle-double-down"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modalUpdate<?= $p->id ?>">Modifier</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modalDelete<?= $p->id ?>">Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Modifier -->
                            <div class="modal fade" id="modalUpdate<?= $p->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="<?= URL ?>pouvoir/update/<?=$p->id?>" method="post">
                                            <div class="modal-header">
                                                <h2 class="modal-title" id="myModalLabel">Modifier </h2>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="nom" value="<?=$p->nom?>">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="description"><?=$p->description?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <input type="submit" class="btn btn-primary" value="Modifier">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="modalDelete<?= $p->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModalLabel">SUPPRILER</h2>
                                        </div>
                                        <div class="modal-body">
                                            <p>Voulez-vous vraiment supprimer le pouvoir <?= $p->nom ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer
                                            </button>
                                            <a type="button" class="btn btn-primary"
                                               href="<?= URL ?>pouvoir/delete/<?= $p->id ?>">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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