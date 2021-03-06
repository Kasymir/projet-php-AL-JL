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
                        <input type="radio" name="civilite"
                               value="1" <?= (isset($this->post['civilite'])) ? (($this->post['civilite'] == 1) ? "checked" : "") : "checked" ?>>
                        M.
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="civilite"
                               value="2" <?= (isset($this->post['civilite'])) ? (($this->post['civilite'] == 2) ? "checked" : "") : "" ?>>
                        Mme.
                    </label>
                </div>

                <!-- CHOOSE THE NAME -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nom"
                               placeholder="Nom" <?= (isset($this->post['nom'])) ? "value='" . $this->post['nom'] . "'" : "" ?>>
                    </div>
                </div>

                <!-- CHOOSE THE PRENOM -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="prenom"
                               placeholder="Prénom" <?= (isset($this->post['prenom'])) ? "value='" . $this->post['prenom'] . "'" : "" ?>>
                    </div>
                </div>

                <!-- CHOOSE THE EMAIL -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email"
                               placeholder="Email" <?= (isset($this->post['email'])) ? "value='" . $this->post['email'] . "'" : "" ?>>
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
                               placeholder="Vérification mot de passe">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Adresse de Livraison :</label>
                    <!-- CHOOSE THE ADRESSE LIVRAISON -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="adresse_l" id="adresse_l"
                                   placeholder="Adresse" <?= (isset($this->post['adresse_l'])) ? "value='" . $this->post['adresse_l'] . "'" : "" ?>>
                        </div>
                    </div>
                    <!-- CHOOSE THE CODE POSTAL -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="code_postal_l" id="code_postal_l"
                                   placeholder="Code postal" <?= (isset($this->post['code_postal_l'])) ? "value='" . $this->post['code_postal_l'] . "'" : "" ?>>
                        </div>
                    </div>
                    <!-- CHOOSE THE CIUDAD -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="ville_l" id="ville_l"
                                   placeholder="Ville" <?= (isset($this->post['ville_l'])) ? "value='" . $this->post['ville_l'] . "'" : "" ?>>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Adresse de facturation :</label>
                    <!-- CHOOSE THE ADRESSE FACTURATION -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="adresse_f" id="adresse_f"
                                   placeholder="Adresse" <?= (isset($this->post['adresse_f'])) ? "value='" . $this->post['adresse_f'] . "'" : "" ?>>
                        </div>
                    </div>
                    <!-- CHOOSE THE CODE POSTAL -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="code_postal_f" id="code_postal_f"
                                   placeholder="Code postal" <?= (isset($this->post['code_postal_f'])) ? "value='" . $this->post['code_postal_f'] . "'" : "" ?>>
                        </div>
                    </div>
                    <!-- CHOOSE THE CIUDAD -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="ville_f" id="ville_f"
                                   placeholder="Ville" <?= (isset($this->post['ville_f'])) ? "value='" . $this->post['ville_f'] . "'" : "" ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="checkbox" id="adresse_identique" name="adresse_identique"><label for="adresse_identique">Adresse de facturation identique à celle de livraison</label>
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
