<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php
            foreach ($this->pouvoir as $p):
                ?>
                <?= $p->nom; ?>
                <br/>
                <?= $p->description; ?>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>

