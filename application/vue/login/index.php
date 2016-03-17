<div class="container">
    <form class="form-signin" role="form" action="<?php echo URL; ?>login/index" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="form-signin-heading">Connexion</h2>
            </div>

            <div class="panel-body">
                <div class="form-group">

                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="pseudo" name="pseudo"
                               placeholder="Pseudo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                    </div>
                </div>

                <div class="form-group">
                    <div class=" col-sm-12">
                        <input type="submit" class="btn btn-primary btn-block" name="login" value="connexion">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

