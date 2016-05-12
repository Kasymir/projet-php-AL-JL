<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>Titre</th>
                <th>Prix</th>
                <th>Version</th>
                <th>Action</th>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Somme : </td><td><?=$this->somme?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Frais de transport : </td><td><?=$this->total?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Total : </td><td><?=$this->total?></td>
                </tr>
                <tr>
                    <td colspan="4"><a class="btn btn-success pull-right">COMMANDER</a></td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                foreach ($this->produits as $p):
                    ?>
                    <tr>
                        <td><?=$p->titre?></td>
                        <td><?=$p->prix?></td>
                        <td><?=$p->version?></td>
                        <td><a class="btn btn-danger">RETIRER</a></td>
                    </tr>
                    <?php
                endforeach;
                ?>
                </tbody>

            </table>
        </div>
    </div>
</div>