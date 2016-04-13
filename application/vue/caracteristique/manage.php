<div class="container">

    <?php
    require VIEWS_PATH . '_templates/menu_admin.php';
    ?>

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>TOUTES LES CARACTERISTIQUES</h1>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <?php
                        foreach ($this->categories as $cat):
                            ?>
                            <th><?=$cat->nom;?></th>
                            <?php
                        endforeach;
                        ?>
                    </tr>
                    <?php
                    foreach ($this->caracteristiques as $c):
                        ?>
                        <tr>
                            <td><?= $c->nom; ?></td>
                            <?php
                            foreach ($this->categories as $cat):
                                $valide = false;
                                foreach ($this->type_caract as $tc):
                                    if($tc->id_type == $cat->id && $tc->id_caracteristique == $c->id):
                                        $valide = true;
                                    endif;
                                endforeach;
                                ?>
                                <td><?=($valide)?"V":""?></td>
                                <?php
                            endforeach;
                            ?>
                        </tr>
                        <?php
                    endforeach;;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

