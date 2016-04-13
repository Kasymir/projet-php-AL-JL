<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_admin.php';
    ?>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1><?= $this->produit->titre ?></h1>
            </div>
            <a data-toggle="modal" data-target="#modalAdd" class="pull-right"><i
                    class="fa fa-plus-square-o fa-2"></i></a>
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
                        <div class="col-md-4 col-md-offset-4">
                            <input type="file" name="img2">
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="img4">
                        </div>
                    </div>

                    <label>Titre :</label>
                    <div class="input-group">
                        <input type="text" value="<?= $this->produit->titre ?>" class="form-control">
                        <div class="input-group-addon btn btn-primary">update</div>
                    </div>


                    <label>Description :</label>
                    <div class="input-group">
                        <textarea class="form-control"><?= $this->produit->description ?></textarea>
                        <div class="input-group-addon btn btn-primary">update</div>
                    </div>


                    <label>Prix : </label>
                    <div class="input-group">
                        <div class="input-group-addon">€</div>
                        <input type="number" value="<?= $this->produit->prix ?>" class="form-control">
                        <div class="input-group-addon btn btn-primary">update</div>
                    </div>

                    <label>Stock : </label>
                    <div class="input-group">
                        <input type="number" value="<?= $this->produit->stock ?>" class="form-control">
                    </div>

                    <?php

                    foreach ($this->allCaracteristique as $k=>$al):
                        ?>
                        <label><?=$k?></label>
                        <div class="input-group">
                            <input type="text" value="<?=$al[0]?>" class="form-control">
                            <div class="input-group-addon btn btn-primary">update</div>
                        </div>
                        <?php
                    endforeach;
                    ?>

                    <label>Visible : </label>
                    <input type="checkbox" <?= ($this->produit->visible == 1) ? "checked" : "" ?> class="form-control">
                </div>
            </div>
            <div class="panel-footer">
                <a href="<?= URL ?>produit/manage" class="btn btn-default btn-primary"> < Retour à la liste des
                    produits</a>
            </div>
        </div>
    </div>
</div>
