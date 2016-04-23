<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">
        <form class="form-signin" role="form" action="<?php echo URL; ?>login/update/<?= $this->adresses->id ?>"
              method="post">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>TOUS LES CLIENTS</h1>
                </div>

                <div class="panel-body">
                    <table class="table tableATrier" id="">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->users as $u):
                            ?>
                            <tr>
                                <td><?=$u->id?></td>
                                <td><?=$u->nom?></td>
                                <td><?=$u->prenom?></td>
                                <td><?=$u->email?></td>
                                <td><?=$u->admin?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            ACTION
                                            <i class="fa fa-angle-double-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#" data-toggle="modal" data-target="#modalUpdate<?=$u->id?>"><i class="fa fa-wrench">&nbsp;</i>Modifier les droits</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalDelete<?=$u->id?>"><i class="fa fa-trash">&nbsp;</i>Supprimer</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal DELETE -->
                            <div class="modal fade" id="modalDelete<?=$u->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Supprimer un client</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Voulez-vous réellement supprimer l'utilisateur <?=$u->prenom?> <?=$u->nom?></p>
                                            <p>Ceci inclus la suppression de toutes les commandes, paniers, commentaires et adresse associés</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <a href="<?=URL?>client/delete/<?=$u->id?>" class="btn btn-danger">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal UPDATE -->
                            <div class="modal fade" id="modalUpdate<?=$u->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Modifier un client</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Voulez-vous réellement mettre ou enlever les droits de l'utilisateur <?=$u->prenom?> <?=$u->nom?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <a href="<?=URL?>client/update/<?=$u->id?>" class="btn btn-primary">Changer les droits</a>
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
        </form>
    </div>
</div>

