
<div class="footer">

</div>

<script src="<?=URL?>public/js/jquery.js"></script>
<script src="<?=URL?>public/js/bootstrap.js"></script>
<script src="<?=URL?>public/js/script.js"></script>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('.tableATrier').dataTable({
            "oLanguage": {
                "sSearch": "Rechercher",
                "sZeroRecords": "Pas de resultat pour cette recherche",
                "sInfoEmpty": "Pas d'entrées",
                "sInfo": "Nombre de resultats: _TOTAL_ (resultat affiché de _START_ to _END_)",
                "sLengthMenu": "Afficher _MENU_ entrées"
            }

        });
    });
</script>


</body>
</html>
