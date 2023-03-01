window.clearSelect = function (selectId){
    $("#"+selectId+" option:first").prop('selected', true);
};

window.clearInput = function (inputId){
    $("#"+inputId).attr('value', '').val('');
}

window.selectIngredient = function (e){
    $("#ingredientAutoComplete").val(e.target.text);
    $("#ingredientAutoComplete").attr('value', e.target.dataset.id);
    $("#ingredientFilterResult").css('display', 'none');
    //console.log(e.target.dataset.id);
};

window.selectRecipeName = function (e){
    $("#recipeNameAutoComplete").val(e.target.text);
    $("#recipeNameAutoComplete").attr('value', e.target.dataset.id);
    $("#recipeNameFilterResult").css('display', 'none');
}

function delay(callback, ms) {
    let timer = 0;
    return function () {
        let context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function (){
           callback.apply(context, args);
        }, ms || 0);
    };
}

$(document).ready(function (){
    /* Ingredients Auto Complete */
    $("#ingredientAutoComplete").on("keyup", delay(function (e){
        let q = $("#ingredientAutoComplete").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                url: '/ingredient/find',
                method: 'post',
                data: {
                    q: q,
                },
                beforeSend: function () {
                    $("#ingredientFilterResult").empty();
                    $("#ingredientFilterResult").css("display", "none");
                },
                success: function (data) {
                    if(q.length >= 2) {
                        $("#ingredientFilterResult").empty();
                        if(data.length >0) {
                            $("#ingredientFilterResult").css("display", "block");
                            $.each(data, function (index, value) {
                                $("#ingredientFilterResult").append("<a class='ingredient__filter_item' data-id='" + value.id + "' onclick='selectIngredient(event)' href='#'>" + value.name + "</a>");
                            });
                        }
                    }
                }
            });
    }, 500));

    /* Recipe name Auto Complete */
    $("#recipeNameAutoComplete").on("keyup", delay(function (e) {
        let q = $("#recipeNameAutoComplete").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            url: '/recipe_name/find',
            method: 'post',
            data:{
                q: q,
            },
            beforeSend: function (){
                $("#recipeNameFilterResult").empty();
                $("#recipeNameFilterResult").css("display", "none");
            },
            success: function (data){
                if(q.length >= 2) {
                    $("#recipeNameFilterResult").empty();
                    if(data.length > 0) {
                        $("#recipeNameFilterResult").css("display", "block");
                        $.each(data, function (index, value) {
                            $("#recipeNameFilterResult").append("<a class='recipe_name__filter_item' data-id='" + value.id + "' onclick='selectRecipeName(event)' href='#'>" + value.name + "</a>");
                        });
                    }
                }
            }
        });
    }, 500));
});
