<div class="container">

    <form class="form-signin" role="form" action="<?php echo URL; ?>login/register" method="post">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h2 class="form-signin-heading">Inscription</h2>
            </div>

            <div class="panel-body">
                <!-- CHOOSE THE SEXE -->
                <div class="form-group  col-md-12">
                    <label class="radio-inline">
                        <input type="radio" name="sexe"
                               value="1" <?= (isset($this->post['sexe'])) ? (($this->post['sexe'] == 1) ? "checked" : "") : "checked" ?>>
                        Homme
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexe"
                               value="2" <?= (isset($this->post['sexe'])) ? (($this->post['sexe'] == 2) ? "checked" : "") : "" ?>>
                        Femme
                    </label>
                </div>

                <!-- CHOOSE THE PSEUDO -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="pseudo"
                               placeholder="Pseudo" <?= (isset($this->post['sexe'])) ? "value='" . $this->post['pseudo'] . "'" : "" ?>>
                    </div>
                </div>

                <!-- CHOOSE THE AGE -->
                <div class="form-group">

                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="age" placeholder="Age" max="100"
                               min="10" <?= (isset($this->post['sexe'])) ? "value='" . $this->post['age'] . "'" : "" ?>>
                    </div>
                </div>

                <!-- CHOOSE THE RACE -->
                <div class="form-group">
                    <select class="form-control" name="race">
                        <?php
                        foreach ($this->race as $r):
                            ?>
                            <option value="<?=$r->id?>"><?=$r->nom?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
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
                               placeholder="Vérification mot de passe">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-block btn-primary" name="register" value="S'incrire">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

