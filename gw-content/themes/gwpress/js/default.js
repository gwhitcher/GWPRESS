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