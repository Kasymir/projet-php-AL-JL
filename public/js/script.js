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

    // Permet d'ajouter ou de supprimer les type_caracteristique
    $(document).on('change','.caracteristiqueAjax', function(e){

        if($(this).val() == 0){
            // on ajoute une nouvelle ligne avec les parametres données dans l'attribut name sous la forme =>
            // caracteristique-categorie

            $checkbox = $(this);
            $tableauID = $checkbox.attr('name').split('-');
            $idCaracteristique = $tableauID[0];
            $idCategorie = $tableauID[1];
            $.ajax({
                url: "http://localhost/projet-php-AL-JL/caracteristiques/addRelation/" + $idCaracteristique + "/" + $idCategorie,
                type: "get",
                data: "html",
                success:function (a) {
                    $checkbox.attr('value',a);
                }
            })
        }else{
            //supprime la ligne avec l'id passer dans la value
            $idTypeCaracteristique = $(this).val();
            $.ajax({
                url: "http://localhost/projet-php-AL-JL/caracteristiques/deleteRelation/" + $idTypeCaracteristique,
                success:function (a){
                    $checkbox.attr('value',a);
                }
            });
        }
    });

});


// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function(e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function(e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {

    $('#stars').on('starrr:change', function(e, value){
        $('input#star').attr('value',value);
    });
    
});