<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>TOUTES LES CARACTERISTIQUES</h1>
            </div>
            <div class="panel-body">
                <a data-toggle="modal" data-target="#modalAdd" class="pull-right"><i
                        class="fa fa-plus-square-o fa-2"></i></a>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <?php
                        foreach ($this->categories as $cat):
                            ?>
                            <th><?=$cat->nom;?></th>
                            <?php
                        endforeach;
                        ?>
                    </tr>
                    <?php
                    foreach ($this->caracteristiques as $c):
                        ?>
                        <tr>
                            <td><?= $c->nom; ?></td>
                            <?php
                            foreach ($this->categories as $cat):
                                $valide = false;
                                $id = 0;
                                foreach ($this->type_caract as $tc):
                                    if($tc->id_type == $cat->id && $tc->id_caracteristique == $c->id):
                                        $valide = true;
                                        $id = $tc->id;
                                    endif;
                                endforeach;
                                ?>
                                <td><input class="caracteristiqueAjax" name="<?=$c->id?>-<?=$cat->id?>" value="<?=$id;?>" type="checkbox" <?=($valide)?"checked>":""?></td>
                                <?php
                            endforeach;
                            ?>
                        </tr>
                        <?php
                    endforeach;;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal ADD -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= URL ?>caracteristiques/add" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter une caractéristique</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="nom" placeholder="Nom de la caractéristique"
                           class="form-control">

                    <h4>Catégories associés</h4>
                    <?php
                    if (sizeof($this->categories) == 0):
                        echo "<p>Aucune categorie n'a été créée</p>";
                    else:
                        ?>
                        <?php foreach ($this->categories as $c): ?>
                        <span class="col-md-3">
                                                <input type="checkbox" name="categorie[<?=$c->id?>]" value="<?= $c->id ?>"/><?= $c->nom ?>
                                            </span>
                        <?php
                    endforeach;
                        ?>
                        <?php
                    endif;
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" name="ajouter" value="Ajouter">
                </div>
            </div>
        </form>
    </div>
</div>

