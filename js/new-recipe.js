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

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var item = document.getElementById('preview');
            item.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('document').ready(function() {
    $('#add-ingredient-btn').click(function() {
        ingredient_name = $('#ingredient_name').val();
        quantity = $('#quantity').val();
        measure = $('#measure').val();
        var ingredient = [ingredient_name, quantity, measure];
        if (isOnEdit) {
            selectedIngr = $('#' + editItemID + " #ingr_name").text(ingredient_name);
            selectedquant = $('#' + editItemID + " #quan").text(quantity);
            selectedmeas = $('#' + editItemID + " #mea").text(measure);
            selectedInput = $('#' + editItemID + ' input').val(ingredient);
            $('#' + editItemID).removeClass('selectedIngr');
            $('#' + editItemID).removeClass('selectedquant');
            $('#' + editItemID).removeClass('selectedmeas');
            $('#' + editItemID).removeClass('selectedInput');
            $('#add-ingredient-btn').attr('value', 'Add ingredient');
            $('#ingredient_name').val('');
            $('#quantity').val('');
            $('#measure').val('');
            isOnEdit = false;
        } else {
            $('#ingredient-container').append("<li id='ingr" + ingrNumber + "'><input type='hidden' name='ingredients[]' value='"+ingredient+"'></input><a id='ingr_name' >" + ingredient_name + "</a><a id='quan'  >" + quantity + "</a> <a id='mea'  >" + measure + "</a><span id='edit" + ingrNumber + "' class='fa fa-pencil-square' style='font-size:24px'></span><span id='delete" + ingrNumber + "' class='fa fa-times-circle' style='font-size:24px''></span></li>");
            $('#edit' + ingrNumber).click(function() {
                isOnEdit = true;
                editItemID = $(this).closest('li').attr('id');
                selectedIngr = $('#' + editItemID + " #ingr_name").text();
                selectedquant = $('#' + editItemID + " #quan").text();
                selectedmeas = $('#' + editItemID + " #mea").text();
                selectedInput = $('#' + editItemID + ' input').val();
                $('li').removeClass('selectedIngr');
                $(this).closest('li').addClass('selectedIngr');
                $('#ingredient_name').val(selectedIngr);

                $('li').removeClass('selectedquant');
                $(this).closest('li').addClass('selectedquant');
                $('#quantity').val(selectedquant);

                $('li').removeClass('selectedmeas');
                $(this).closest('li').addClass('selectedmeas');
                $('#measure').val(selectedmeas);

                $('li').removeClass('selectedInput');
                $(this).closest('li').addClass('selectedInput');
                $('input').val(selectedInput);

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
});
function newFunction() {
    return 'ingredient-container';
}