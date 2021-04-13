$( document ).ready(function() {
    $('.form_item_with_error .form_item_input').keyup(function (e) {
        $(e.target).closest('.form_item_with_error').find('.form_item__error').remove();
    })
});
