<div class="container">

    <div class="col-md-3 col-xs-12">
        <div class="btn-group-vertical col-md-12" role="group">
            <a class="btn btn-default" href="<?= URL ?>profil/index">Mon Profil</a>
            <a class="btn btn-default" href="<?= URL ?>profil/adresse">Mes adresses</a>
            <a class="btn btn-default" href="<?= URL ?>profil/commandePassees">Mes commandes passées</a>
            <a class="btn btn-default" href="<?= URL ?>profil/commandeEnCours">Mes commandes en cours</a>
        </div>
    </div>
    <div class="col-md-9">
        <form class="form-signin" role="form" action="<?php echo URL; ?>login/update/<?= $this->adresses->id ?>"
              method="post">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>MES ADRESSES</h1>
                </div>

                <div class="panel-body">
                    <?php
                    foreach ($this->adresses as $a):
                        ?>
                        <?php echo "<pre>";
                        var_dump($a);
                        echo "</pre>"; ?>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>

