<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PETITE GAME ?</title>
    
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    <link href="<?=URL?>public/css/style.css" rel="stylesheet">

</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?= ($this->checkForActiveControllerAndAction($filename, "index/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index"><i class="fa fa-home"></i></a>
                </li>
                <li <?= ($this->checkForActiveControllerAndAction($filename, "film/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index">FILM</a>
                </li>
                <li <?= ($this->checkForActiveControllerAndAction($filename, "serie/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index">SERIE</a>
                </li>
                <li <?= ($this->checkForActiveControllerAndAction($filename, "musique/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index">MUSIQUE</a>
                </li>
                <li <?= ($this->checkForActiveControllerAndAction($filename, "bd/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index">BDs</a>
                </li>
                <li <?= ($this->checkForActiveControllerAndAction($filename, "jeux/index")) ? 'class="active"' : ""; ?>>
                    <a href="<?php echo URL; ?>index">JEUX</a>
                </li>
                <li>
                    <form action="" class="navbar-form navbar-right">
                        <input class="form-control" placeholder="Rechercher">
                        <button type="submit" class="btn btn-default" name="rechercher"><i class="fa fa-search"></i></button>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (Session::get('user_name') == true) { ?>
                    <li><p class="navbar-text">Bienvenue <?php echo Session::get('user_name'); ?></p></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Mon compte<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo URL; ?>login/monProfil">Mon profil</a>
                            </li>
                            <?php
                            if ((SESSION::get('user_admin')) == 1) :
                                ?>
                                <li>
                                    <a href="<?php echo URL; ?>">Gestion clients</a>
                                </li>
                                <li>
                                    <a href="<?php echo URL; ?>">Gestion commandes</a>
                                </li>
                                <li>
                                    <a href="<?php echo URL; ?>">Gestion commantaires</a>
                                </li>
                                <li>
                                    <a href="<?php echo URL; ?>">Gestion produits</a>
                                </li>
                                <?php
                            endif;
                            ?>
                            <li>
                                <a href="<?php echo URL; ?>login/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li <?= ($this->checkForActiveControllerAndAction($filename, "login/index")) ? 'class="active"' : ""; ?>>
                        <a href="<?php echo URL . 'login'; ?>"><i class="fa fa-sign-in"></i></a></li>
                    <li <?= ($this->checkForActiveControllerAndAction($filename, "login/inscription")) ? 'class="active"' : ""; ?>>
                        <a href="<?php echo URL . 'login/register'; ?>"><i class="fa fa-user-plus"></i></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
</div>
