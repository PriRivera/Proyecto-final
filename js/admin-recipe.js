function changeState(id){
    $.ajax({
        method:'POST',
        url: 'admin-recipe.php',
        data:{
            id_recipe: id,
            recipe_status: getInputValue(id)
        },
        error: function() {
            console.log('ERROR');
        },
        dataType: 'text',
        success: function (data) {
            var tempId = "#recipe_li-"+id;
            $('li').remove(tempId);
        }
    });
}
function getInputValue(id){
    return $('#recipe_'+id).val();
}
function likeRecipe(idRecipe, idUser){
    $.ajax({
        method:'POST',
        url: 'admin-recipe.php',
        data:{
            id_recipe: idRecipe,
            id_user: idUser,
            like: true
        },
        error: function() {
            console.log('ERROR');
        },
        dataType: 'text',
        success: function (data) {
            document.getElementById("likeBtn").style.display = "none";
            document.getElementById("dislikeBtn").style.display = "block";
        }
    });
}
function dislikeRecipe(idRecipe, idUser){
    $.ajax({
        method:'POST',
        url: 'admin-recipe.php',
        data:{
            id_recipe: idRecipe,
            id_user: idUser,
            dislike: true
        },
        error: function() {
            console.log('ERROR');
        },
        dataType: 'text',
        success: function (data) {
            document.getElementById("likeBtn").style.display = "block";
            document.getElementById("dislikeBtn").style.display = "none";
        }
    });
}