<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <form action="<?= URL ?>produit/update/<?= $this->produit->id ?>" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1><?= $this->produit->titre ?></h1>
                </div>
                <div class="panel-body">
                    <div class="form-group col-md-12">

                        <div class="row">
                            <img class="col-md-4" src="<?= URL . $this->images[0]->url ?>"/>
                            <img class="col-md-4"
                                 src="<?= URL . (isset($this->images[1]->url) ? $this->images[1]->url : "public/images/jesuisabsente.png") ?>"/>
                            <img class="col-md-4"
                                 src="<?= URL . (isset($this->images[2]->url) ? $this->images[2]->url : "public/images/jesuisabsente.png") ?>"/>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="file"
                                       name="<?= (isset($this->images[0]->id) ? $this->images[0]->id : "img1") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <input type="file"
                                       name="<?= (isset($this->images[1]->id) ? $this->images[1]->id : "img2") ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="file"
                                       name="<?= (isset($this->images[2]->id) ? $this->images[2]->id : "img3") ?>">
                            </div>
                        </div>

                        <label>Titre :</label>
                        <input type="text" value="<?= $this->produit->titre ?>" class="form-control" name="titre">


                        <label>Description :</label>
                            <textarea name="description"
                                      class="form-control"><?= $this->produit->description ?></textarea>


                        <label>Prix : </label>
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input name="prix" type="number" value="<?= $this->produit->prix ?>"
                                   class="form-control">
                        </div>

                        <label>Stock : </label>
                        <input name="stock" type="number" value="<?= $this->produit->stock ?>" class="form-control">

                        <?php

                        foreach ($this->allCaracteristique as $k => $al):
                            ?>
                            <label><?= $k ?></label>
                            <input type="text" value="<?= $al[0] ?>" class="form-control"
                                   name="caracteristiques[<?= $al[1] ?>]">
                            <?php
                        endforeach;
                        ?>

                        <label>Visible : </label>
                        <input name="visible" type="checkbox" <?= ($this->produit->visible == 1) ? "checked" : "" ?>
                               class="form-control">
                    </div>

                    <h3>LES EXTRAITS<a data-toggle="modal" data-target="#modalAddExtrait" class="pull-right"><i
                                class="fa fa-plus-square-o fa-1"></i></a></h3>
                    <?php foreach ($this->extrait as $e): ?>
                        <div class="col-md-9">
                            <label><?= $e->nom; ?></label>
                            <audio controls>
                                <source src="<?= URL . $e->url ?>">
                            </audio>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-danger" href="<?=URL?>produit/deleteExtrait/<?=$e->id?>">Supprimer</a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="panel-footer">
                    <a href="<?= URL ?>produit/manage" class="btn btn-default btn-default"> < Retour à la liste des
                        produits</a>

                    <input type="submit" class="btn btn-primary pull-right" value="Modifier" name="modifier"/>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal ADD EXTRAIT -->
<div class="modal fade" id="modalAddExtrait" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= URL ?>produit/addExtrait/<?= $this->produit->id ?>" method="post"
              enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Ajouter un extrait</h2>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label>Titre : </label>
                        <input type="text" name="titre" class="form-control">
                        <input type="file" name="extrait" class="form-control"/>
                        <select name="type" class="form-control">
                            <option value="video">Video</option>
                            <option value="audio">Audio</option>
                        </select>
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

