<div class="container">
    <div class="row">
        <?php
        foreach ($this->produits as $p):
            ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?= URL . $p->url ?>"/>
                    <a href="<?=URL?>produit/index/<?=$p->pid?>">
                    <h3><?= ucfirst($p->titre) ?></h3>
                    </a>
                    <p><?= substr($p->description, 0, 150) ?> ... </p>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>
