$(document).ready(function () {
    
    
    // Fonction a l'inscription permettant de bloquer l'adresse de livraison si elles sont identiques
    $(document).on("click","#adresse_identique",function(e){

        if($(this).is(":checked")){
            $('#adresse_f').attr('readonly','true');
            $('#code_postal_f').attr('readonly','true');
            $('#ville_f').attr('readonly','true');

            $('#adresse_f').val($("#adresse_l").val());
            $('#code_postal_f').val($("#code_postal_l").val());
            $('#ville_f').val($("#ville_l").val());

        }else{
            $('#adresse_f').removeAttr('readonly');
            $('#code_postal_f').removeAttr('readonly');
            $('#ville_f').removeAttr('readonly');
        }
    });
});
