//Highlight active page
$(document).ready(function () {
    var action = window.location.pathname.split('/')[1];

    // If there's no action, highlight the first menu item
    if (action == "") {
        $('ul.nav li:first').addClass('active');
    } else {
        // Highlight current menu
        $('ul.nav a[href="/' + action + '"]').parent().addClass('active');

        // Highlight parent menu item
        $('ul.nav a[href="/' + action + '"]').parents('li').addClass('active');
    }
});

//Flash message disappear
jQuery(document).ready(function($){
    if('.fadeout-message'){
        setTimeout(function() {
            $('.flash_message').slideUp(1200);
        }, 5000);
    }
});

//Selectize
$('#category_id').selectize({
    delimiter: ',',
    persist: false,
    create: false
});

//TINYMCE
tinymce.init({
        selector: "#body, #description",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor uploadmanager"
        ]
});
// Prevent bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

unloadTiny = function(){
    tinymce.remove('textarea');
}

//Tooltips
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});