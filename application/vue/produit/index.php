<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img style="width: 100%" src="<?=URL . $this->image_main->url?>"/>
            <div class="row">
                <?php
                foreach ($this->images as $image):
                    ?>
                    <img class="col-md-4" src="<?=URL . $image->url?>" />
                    <?php
                endforeach;
                ?>
            </div>
        </div>
        <div class="col-md-8">
            <h2><?=ucfirst($this->produit->titre)?></h2>
            <p>
                <?=$this->produit->description?>
            </p>
            <p>
                <?=$this->produit->prix?>€
            </p>
            <a href="<?=URL?>panier/addProduit/<?=$this->produit->id?>/0" class="btn btn-default">AJOUTER AU PANIER (version numérique)</a>
            <a href="<?=URL?>panier/addProduit/<?=$this->produit->id?>/1" class="btn btn-default">AJOUTER AU PANIER (version physique)</a>
        </div>
    </div>
    <div class="row">
        <h3>Caracteristiques</h3>
    </div>
</div>