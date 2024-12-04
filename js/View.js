$(document).ready(function () {
    // Change nav-bar appearance on scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 100) {
            $('.fixed-nav-bar').addClass('scrolled');
            $('.the-bass').addClass('scrolled');
        } else {
            $('.fixed-nav-bar').removeClass('scrolled');
            $('.the-bass').removeClass('scrolled');
        }
    });

    // Toggle dropdown on checkbox state
    $('#menuButton').on('change', function () {
        if ($(this).is(':checked')) {
            $('.the-bass').addClass('dropped');
        } else {
            $('.the-bass').removeClass('dropped');
        }
    });
});
