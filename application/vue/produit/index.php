<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= ucfirst($this->produit->titre) ?></h1>
        </div>

        <div class="panel-body">

            <!-- IMAGE PRODUIT -->

            <div class="row">
                <div class="col-md-4">
                    <img style="width: 100%" src="<?= URL . $this->image_main->url ?>" data-toggle="modal"
                         data-target="#modelImageMain"/>

                    <!-- Modal -->
                    <div class="modal fade" id="modelImage<?= $image->id ?>" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <img class="col-md-12" src="<?= URL . $image->url ?>"/>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row imgSupplementaires">
                        <?php
                        foreach ($this->images as $image):
                            ?>
                            <img class="col-md-4" src="<?= URL . $image->url ?>" data-toggle="modal"
                                 data-target="#modelImage<?= $image->id ?>"/>

                            <!-- Modal -->
                            <div class="modal fade" id="modelImage<?= $image->id ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="col-md-12" src="<?= URL . $image->url ?>"/>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>

                <!-- DESCRIPTION PRODUIT -->

                <div class="col-md-5">
                    <p>
                        <?= $this->produit->description ?>
                    </p>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <h2>
                            €<?= $this->produit->prix ?>
                        </h2>
                        <a href="<?= URL ?>panier/addProduit/<?= $this->produit->id ?>/0"
                           class="btn btn-info btn-block">AJOUTER AU
                            PANIER <br/>(version numérique)</a>


                        <?php
                        if ($this->produit->stock > 0): ?>
                            <a href="<?= URL ?>panier/addProduit/<?= $this->produit->id ?>/1"
                               class="btn btn-primary btn-block">AJOUTER
                                AU PANIER <br/>(version physique)</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- CARACTERISTIQUE PRODUIT -->

            <div class="row">
                <div class="col-md-12">
                    <h3>Détails</h3>
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


            <!-- EXTRAIT AUDIO -->

            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (sizeof($this->extraits_music) > 0):
                        ?>
                        <h3>Extraits Musicaux</h3>
                        <?php
                        foreach ($this->extraits_music as $em):
                            ?>
                            <div class="col-md-3">
                                <?= ucfirst($em->nom) ?>
                            </div>
                            <audio controls="controls">
                                <source src="<?= URL . $em->url ?>" type="audio/mp3"/>
                                Votre navigateur ne supporte pas le tag
                            </audio>

                            <?php
                        endforeach;
                        ?>

                        <?php
                    endif;
                    ?>

                </div>
            </div>

            <!-- EXTRAIT VIDEO -->

            <div class="row">
                <div class="col-md-12">


                    <?php
                    if (sizeof($this->extraits_video) > 0):
                        ?><h3>Extraits video</h3><?php
                        foreach ($this->extraits_video as $ev):
                            ?>
                            <div class="col-md-3">
                                <?= ucfirst($ev->nom) ?>
                            </div>
                            <video controls>
                                <source src="<?= URL . $ev->url ?>">
                            </video>
                            <?php
                        endforeach;
                        ?>

                        <?php
                    endif;
                    ?>

                </div>
            </div>


            <!-- COMMENTAIRES -->

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCommentaire"
                    style="margin-bottom:10px;">
                Rédiger un commentaire
            </button>

            <div class="row">
                <div class="col-md-12">

                    <?php
                    foreach ($this->avis as $a):
                        ?>
                        de <i><?= ucfirst($a->nom) . " " . ucfirst($a->prenom) ?></i> - note : <?= $a->note ?>/5
                        <div class="well">
                            <a href="<?= URL ?>commentaires/delete/<?= $a->id ?>/<?= $this->produit->id ?>"><span
                                    class="glyphicon glyphicon-remove pull-right"></span></a>
                            <?= $a->commentaire ?>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal commentaire -->
<div class="modal fade" id="modalCommentaire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rédiger un commentaire</h4>
            </div>
            <form action="<?= URL ?>commentaires/ajouterCommentaire/<?= $this->produit->id ?>" method="post">
                <div class="modal-body">

                    <label for="note">
                        Note :
                    </label>
                    <div class="row lead text-center">
                        <div id="stars" class="starrr"></div>
                        <input type="hidden" name="range" value="0" id="star">
                    </div>
                    <label for="avis">
                        Votre message :
                    </label>
                    <textarea name="avis" class="form-control" rows="5"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" name="submit" value="envoyer" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>