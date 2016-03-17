<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="tables">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            gestion des races
                        </div>
                        <div class="text-right col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-square-o fa-2"
                                                                                       style="color: white"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Modal Add -->
                <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="<?= URL ?>race/ajouter" method="post">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="myModalLabel">AJOUTER UNE RACE</h2>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="nom"
                                                   placeholder="Nom de la race">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="form-control" name="id_pouvoir">
                                                <?php foreach ($this->pouvoirs as $p): ?>
                                                    <option value="<?= $p->id ?>"><?= $p->nom ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                            <th>Pouvoir</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->race as $r):
                            ?>
                            <tr>
                                <td><?= $r->id; ?></td>
                                <td><?= $r->nom; ?></td>
                                <?php foreach ($this->pouvoirs as $p): ?>
                                    <?= ($p->id == $r->id_pouvoir) ? "<td>" . $p->nom . "</td>" : ""; ?>
                                <?php endforeach; ?>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Action <span class="fa fa-angle-double-down"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modalUpdate<?= $r->id ?>">Modifier</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modalDelete<?= $r->id ?>">Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Modifier -->
                            <div class="modal fade" id="modalUpdate<?= $r->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="<?= URL ?>race/update/<?= $r->id ?>" method="post">
                                            <div class="modal-header">
                                                <h2 class="modal-title" id="myModalLabel">Modifier </h2>
                                            </div>
                                            <div class="modal-body">
                                                <input class="form-control" type="text" name="nom"
                                                       value="<?= $r->nom ?>">
                                                <select class="form-control" name="id_pouvoir">
                                                    <?php foreach ($this->pouvoirs as $p): ?>
                                                        <option value="<?= $p->id ?>" <?=($p->id==$r->id)?"selected":""?>><?= $p->nom ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="modalDelete<?= $r->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModalLabel">SUPPRILER</h2>
                                        </div>
                                        <div class="modal-body">
                                            <p>Voulez-vous vraiment supprimer la race <?= $r->nom ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer
                                            </button>
                                            <a type="button" class="btn btn-primary"
                                               href="<?= URL ?>race/delete/<?= $r->id ?>">Supprimer</a>
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