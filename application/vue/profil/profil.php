<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_gauche.php';
    ?>

    <div class="col-md-9">
        <form class="form-signin" role="form" action="<?php echo URL; ?>profil/update/<?= $this->infoUser->id ?>"
              method="post">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>MON PROFIL</h1>
                </div>

                <div class="panel-body">
                    <!-- CHOOSE THE SEXE -->
                    <div class="form-group ">
                        <div class="col-md-12">
                            <label class="radio-inline">
                                <input type="radio" name="sexe"
                                       value="1" <?= ($this->infoUser->civilite == 1) ? "checked" : "" ?>>
                                Homme
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sexe"
                                       value="2" <?= ($this->infoUser->civilite != 1) ? "checked" : "" ?>>
                                Femme
                            </label>
                        </div>
                    </div>

                    <!-- CHOOSE THE FIRSTNAME -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="prenom"
                                   value="<?= $this->infoUser->prenom ?>">
                        </div>
                    </div>
                    <!-- CHOOSE THE LASTNAME -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nom" value="<?= $this->infoUser->nom ?>">
                        </div>
                    </div>
                    <!-- CHOOSE THE PASSWORD -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Mot de passe">
                        </div>
                    </div>
                    <!-- CHECK PASSWORD -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password_verify"
                                   placeholder="vérification">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-block" name="update" value="Modifier">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

