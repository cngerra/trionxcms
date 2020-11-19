/*admin common functions*/

function startLoading(button, btnText) {
    button.html(btnText+' <i class="fa fa-spinner fa-spin"></i>');
    button.addClass('disabled');
}
function endLoading(button, button_str) {
    button.html(button_str);
    button.removeClass('disabled');
}