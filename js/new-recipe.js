var ingrNumber = 1;
var isOnEdit = false;
var ingredient_name = "";
var quantity = "";
var measure = "";
var editItemID = "";
var ingredient = "";
var selectedIngr = "";
var selectedquant = "";
var selectedmeas = "";

var el = document.getElementById('ingredient-container');
var sortable = Sortable.create(el);

$('document').ready(function() {
    $('#add-ingredient-btn').click(function() {
        ingredient_name = $('#ingredient_name').val();
        quantity = $('#quantity').val();
        measure = $('#measure').val();

        if (isOnEdit) {
            selectedIngr = $('#' + editItemID + " #ingr_name").text(ingredient_name);
            selectedquant = $('#' + editItemID + " #quan").text(quantity);
            selectedmeas = $('#' + editItemID + " #mea").text(measure);

            console.log(editItemID);
            $('#' + editItemID).removeClass('selectedIngr');
            $('#' + editItemID).removeClass('selectedquant');
            $('#' + editItemID).removeClass('selectedmeas');
            $('#add-ingredient-btn').attr('value', 'Add ingredient');
            $('#ingredient_name').val('');
            $('#quantity').val('');
            $('#measure').val('');

            isOnEdit = false;

        } else {

            $('#ingredient-container').append("<li id='ingr" + ingrNumber + "'> <a id='ingr_name' >" + ingredient_name + "</a> <a id='quan'  >" + quantity + "</a> <a id='mea'  >" + measure + "</a> <span id='edit" + ingrNumber + "' class='fa fa-pencil-square' style='font-size:24px'></span> <span id='delete" + ingrNumber + "' class='fa fa-times-circle' style='font-size:24px''></span></li>");

            $('#edit' + ingrNumber).click(function() {

                isOnEdit = true;
                editItemID = $(this).closest('li').attr('id');

                selectedIngr = $('#' + editItemID + " #ingr_name").text();
                selectedquant = $('#' + editItemID + " #quan").text();
                selectedmeas = $('#' + editItemID + " #mea").text();

                $('li').removeClass('selectedIngr');
                $(this).closest('li').addClass('selectedIngr');
                $('#ingredient_name').val(selectedIngr);
                //console.log(selectedIngr);

                $('li').removeClass('selectedquant');
                $(this).closest('li').addClass('selectedquant');
                $('#quantity').val(selectedquant);
                //console.log(selectedquant);

                $('li').removeClass('selectedmeas');
                $(this).closest('li').addClass('selectedmeas');
                $('#measure').val(selectedmeas);
                //console.log(selectedmeas);

                $('#add-ingredient-btn').attr('value', 'Update ingredient');

            });

            $('#delete' + ingrNumber).click(function() {
                $(this).closest('li').remove();
            });
            $('#ingredient_name').val('');
            $('#quantity').val('');
            $('#measure').val('');
            ingrNumber++;
        }
    });
    $('#submit-recipe').click(function(){
        var file = $('#file')[0];
        file = file.files[0];
        formData = new FormData(file);
        var recipeName = $('#recipe-name').val();
        var recipeDescription = $('#recipe-description').val();
        var ingredients = $('#ingredient-container').children();
        var recipeInstructions = $('#recipe-instructions').val();
        
        var total = [];
        for (i = 0; i < ingredients.length; i++) {
            var item = [];
            var element = ingredients[i];
            element = $(element).children();
            item.push($(element[0]).text());
            item.push($(element[1]).text());
            item.push($(element[2]).text());
            total.push(item);
        }
        $.ajax({
            method:'POST',
            url: 'php/server.php',
            data:{
                recipeName: recipeName,
                recipeDescription: recipeDescription,
                recipeInstructions: recipeInstructions,
                ingredients: total/*,
                image: formData*/
            },
            /*processData: false,
            contentType: false,*/
            error: function() {
                console.log('ERROR');
            },
            dataType: 'text',
            success: function (data) {
                console.log(data);
                console.log(formData);
            }
        });
    });
});
function newFunction() {
    return 'ingredient-container';
}