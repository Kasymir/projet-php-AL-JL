<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>
    
    <div class="col-md-9">
        <form class="form-signin" role="form" action="<?php echo URL; ?>login/update/<?= $this->infoUser->id ?>"
              method="post">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>MES COMMANDES PASSEES</h1>
                </div>

                <div class="panel-body">
                </div>
            </div>
        </form>
    </div>
</div>

