$(document).ready(function () {


    // Fonction a l'inscription permettant de bloquer et preremplir l'adresse de livraison si elles sont identiques
    $(document).on("click", "#adresse_identique", function (e) {

        if ($(this).is(":checked")) {
            $('#adresse_f').attr('readonly', 'true');
            $('#code_postal_f').attr('readonly', 'true');
            $('#ville_f').attr('readonly', 'true');

            $('#adresse_f').val($("#adresse_l").val());
            $('#code_postal_f').val($("#code_postal_l").val());
            $('#ville_f').val($("#ville_l").val());

        } else {
            $('#adresse_f').removeAttr('readonly');
            $('#code_postal_f').removeAttr('readonly');
            $('#ville_f').removeAttr('readonly');
        }
    });


    // Dans la gestion d'ajout Catégorie, ajout des inputs si celui du dessus n"est pas vide
    $(document).on('keyup', '.carac-categorie', function (e) {

        console.log(e.keyCode);

        if ((e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode == 8 || e.keyCode == 46) {
            // caracteristique-categorie = id du groupe
            //recuperation id input
            $id = parseInt($(this).attr('id').charAt($(this).attr('id').length - 1)) + 1;

            console.log($id);

            if ($(this).val().length > 0) {
                if ($(this).val().length < 2)
                    $("#caracteristique-categorie").append('<input type ="text" name="caracteristique[]" placeholder="caracteristique associé" class="form-control carac-categorie" id="carac' + $id + '" >');
            } else {
                if($id>1)
                    $(this).remove();
            }
        }
    });

    // Permet d'ajouter les champs de caracteristique selon la categorie du produit
    $(document).on('change', '#categorieProduct', function (e) {
        $.ajax({
            url: "http://localhost/projet-php-AL-JL/produit/getCaracteristique/" + $(this).val(),
            type: "get",
            data: "html",
            success: function (e) {
                $('#form-group-categorie').empty();
                $('#form-group-categorie').append(e);
            },
            error: function (e) {

            }
        });
    });

});
