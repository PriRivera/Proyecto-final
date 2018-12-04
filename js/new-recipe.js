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
    var el = document.getElementById('ingredient-container');
    var sortable = Sortable.create(el);
    $('#add-ingredient-btn').click(function() {
        ingredient_name = $('#ingredient_name').val();
        quantity = $('#quantity').val();
        measure = $('#measure').val();
        if (isOnEdit) {
            selectedIngr = $('#' + editItemID + " #ingr_name").text(ingredient_name);
            selectedquant = $('#' + editItemID + " #quan").text(quantity);
            selectedmeas = $('#' + editItemID + " #mea").text(measure);
            selectedInputIngr = $('#' + editItemID + ' #input_ingr_name').val(ingredient_name);
            selectedInputQuant = $('#' + editItemID + ' #input_quan').val(quantity);
            selectedInputMeas = $('#' + editItemID + ' #input_mea').val(measure);
            $('#' + editItemID).removeClass('selectedIngr');
            $('#' + editItemID).removeClass('selectedquant');
            $('#' + editItemID).removeClass('selectedmeas');
            $('#' + editItemID).removeClass('selectedInputIngr');
            $('#' + editItemID).removeClass('selectedInputQuant');
            $('#' + editItemID).removeClass('selectedInputMeas');
            $('#add-ingredient-btn').attr('value', 'Add ingredient');
            $('#ingredient_name').val('');
            $('#quantity').val('');
            $('#measure').val('');
            isOnEdit = false;
        } else {
            $('#ingredient-container').append("<li id='ingr" + ingrNumber + "'><input id='input_ingr_name' type='hidden' name='ingredientName[]' value='"+ingredient_name+"'><input id='input_quan' type='hidden' name='ingredientQuantity[]' value='"+quantity+"'><input id='input_mea' type='hidden' name='ingredientMeasure[]' value='"+measure+"'></input><a id='ingr_name' >" + ingredient_name + "&#160; &#160;" + "</a><a id='quan'  >" + quantity + "</a> <a id='mea'  >" + "&#160; &#160;"  + measure + "&#160; &#160;" + "</a><span id='edit" + ingrNumber + "' class='fa fa-pencil-square' style='font-size:24px'></span>&#160; &#160;<span id='delete" + ingrNumber + "' class='fa fa-times-circle' style='font-size:24px''></span></li>");
            $('#edit' + ingrNumber).click(function() {
                isOnEdit = true;
                editItemID = $(this).closest('li').attr('id');
                selectedIngr = $('#' + editItemID + " #ingr_name").text();
                selectedquant = $('#' + editItemID + " #quan").text();
                selectedmeas = $('#' + editItemID + " #mea").text();
                selectedInputIngr = $('#' + editItemID + ' #input_ingr_name').val();
                selectedInputQuant = $('#' + editItemID + ' #input_quan').val();
                selectedInputMeas = $('#' + editItemID + ' #input_mea').val();
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
                $(this).closest('li').addClass('selectedInputIngr');
                $('#input_ingr_name').val(selectedInputIngr);
                $(this).closest('li').addClass('selectedInputQuant');
                $('#input_quan').val(selectedInputQuant);
                $(this).closest('li').addClass('selectedInputMeas');
                $('#input_mea').val(selectedInputMeas);
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
function loadIngredient(ingredient_name, quantity, measure){
    $('#ingredient-container').append("<li id='ingr" + ingrNumber + "'><input id='input_ingr_name' type='hidden' name='ingredientName[]' value='"+ingredient_name+"'><input id='input_quan' type='hidden' name='ingredientQuantity[]' value='"+quantity+"'><input id='input_mea' type='hidden' name='ingredientMeasure[]' value='"+measure+"'></input><a id='ingr_name' >" + ingredient_name + "&#160; &#160;" + "</a><a id='quan'  >" + quantity + "</a> <a id='mea'  >" + "&#160; &#160;"  + measure + "&#160; &#160;" + "</a><span id='edit" + ingrNumber + "' class='fa fa-pencil-square' style='font-size:24px'></span>&#160; &#160;<span id='delete" + ingrNumber + "' class='fa fa-times-circle' style='font-size:24px''></span></li>");
    $('#edit' + ingrNumber).click(function() {
        isOnEdit = true;
        editItemID = $(this).closest('li').attr('id');
        selectedIngr = $('#' + editItemID + " #ingr_name").text();
        selectedquant = $('#' + editItemID + " #quan").text();
        selectedmeas = $('#' + editItemID + " #mea").text();
        selectedInputIngr = $('#' + editItemID + ' #input_ingr_name').val();
        selectedInputQuant = $('#' + editItemID + ' #input_quan').val();
        selectedInputMeas = $('#' + editItemID + ' #input_mea').val();
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
        $(this).closest('li').addClass('selectedInputIngr');
        $('#input_ingr_name').val(selectedInputIngr);
        $(this).closest('li').addClass('selectedInputQuant');
        $('#input_quan').val(selectedInputQuant);
        $(this).closest('li').addClass('selectedInputMeas');
        $('#input_mea').val(selectedInputMeas);
        $('#add-ingredient-btn').attr('value', 'Update ingredient');
    });
    $('#delete' + ingrNumber).click(function() {
        $(this).closest('li').remove();
    });   
    ingrNumber++;
}