<div class="container">
    <div class="row">
        <?php
        foreach ($this->produits as $p):
            ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?= URL . $p->url ?>"/>
                    <div class="caption">
                        <a href="<?= URL ?>produit/index/<?= $p->pid ?>">

                            <h3><?= ucfirst($p->titre) ?></h3>
                        </a>
                        <p><?= substr($p->description, 0, 150) ?> ... </p>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>

    <!-- MEILLEURES VENTES -->

    <?php
    if (sizeof($this->meilleuresVentes)>0):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Les meilleures ventes</h3>
                </div>

                <div class="panel-body">
                    <?php
                    foreach ($this->meilleuresVentes as $p):
                        ?>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="<?= URL . $p->url ?>"/>
                                <div class="caption">
                                    <a href="<?= URL ?>produit/index/<?= $p->id ?>">
                                        <h3><?= ucfirst($p->titre) ?></h3>
                                    </a>
                                    <p><?= substr($p->description, 0, 150) ?> ... </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>

    <!-- NOUVEAUTE -->

    <?php
    if (sizeof($this->nouveaux)>0):
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Nouveautés</h3>
                    </div>

                    <div class="panel-body">
                        <?php
                        foreach ($this->nouveaux as $n):
                            ?>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <img src="<?= URL . $n->url ?>"/>
                                    <div class="caption">
                                        <a href="<?= URL ?>produit/index/<?= $n->id ?>">
                                            <h3><?= ucfirst($n->titre) ?></h3>
                                        </a>
                                        <p><?= substr($n->description, 0, 150) ?> ... </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

