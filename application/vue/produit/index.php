<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= ucfirst($this->produit->titre) ?></h1>
        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-4">
                    <img style="width: 100%" src="<?= URL . $this->image_main->url ?>"/>
                    <div class="row imgSupplementaires">
                        <?php
                        foreach ($this->images as $image):
                            ?>
                            <img class="col-md-4" src="<?= URL . $image->url ?>"/>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2>Description : </h2>
                    <p>
                        <?= $this->produit->description ?>
                    </p>
                    <h3>Prix : </h3>
                    <p>
                        <?= $this->produit->prix ?>€
                    </p>
                    <a href="<?= URL ?>panier/addProduit/<?= $this->produit->id ?>/0" class="btn btn-info">AJOUTER AU
                        PANIER (version numérique)</a>
                    <a href="<?= URL ?>panier/addProduit/<?= $this->produit->id ?>/1" class="btn btn-primary">AJOUTER AU
                        PANIER (version physique)</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Caracteristiques</h3>
                    <table class="table table-striped">
                        <?php
                        foreach ($this->caracteristiques as $c):
                            ?>
                            <tr>
                                <td><?= $c->nom ?></td>
                                <td><?= $c->value ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3>Extrait</h3>
                    <?php
                    foreach ($this->extraits as $e):
                        ?><?=URL . $e->url?>
                        <video width="320" height="240" autoplay>
                            <source src="<?=URL . $e->url?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <?php
                    endforeach;
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>