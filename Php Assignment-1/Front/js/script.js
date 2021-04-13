$(function () {

    // show/hide nav on page load
    showHideNav();

    $(window).scroll(function () {

        // show/hide nav on window's scroll
        showHideNav();

    });

    function showHideNav() {

        if ($(window).scrollTop() > 50) {

            // show white nav
            $('#home-nav').removeClass('bg-dark-1');
            $('#home-nav').addClass('bg-white');

            // show dark logo
            $("#home-nav .navbar-brand img").attr("src", "images/Homepage/logo.png");

            // Show Back To Top button
            $('#home-login-btn-white').removeClass('btn-white');
            $('#home-login-btn-white').addClass('btn-purple');

        } else {

            // hide white nav
            $('#home-nav').removeClass('bg-white');
            $('#home-nav').addClass('bg-dark-1');

            // show dark logo
            $("#home-nav .navbar-brand img").attr("src", "images/Homepage/top-logo.png");

            // Show Back To Top button
            $('#home-login-btn-white').removeClass('btn-purple');
            $('#home-login-btn-white').addClass('btn-white');
        }
    }

});

function faq(q1) {
    var img = document.getElementById('faq-' + q1 + '-img-add').className;
    if (img == 'add-img') {
        $("." + q1 + "-img img").attr("src", "images/FAQ/minus.png");
        $("." + q1 + "-img img").removeClass("add-img");
        $("." + q1 + "-img img").addClass("minus-img");
        $("#faq-" + q1).addClass("accordion-flush");
    } else {
        $("." + q1 + "-img img").attr("src", "images/FAQ/add.png");
        $("." + q1 + "-img img").removeClass("minus-img");
        $("#faq-" + q1).removeClass("accordion-flush");
        $("." + q1 + "-img img").addClass("add-img");
    }
}
$(".toggle-password").click(function () {
    var input = $('#login-password').attr("type");
    if (input == "password") {
        $('#login-password').attr("type", "text");
    } else {
        $('#login-password').attr("type", "password");
    }
});

$(".toggle-password-old").click(function () {
    var input = $('#change-pass-old-password').attr("type");
    if (input == "password") {
        $('#change-pass-old-password').attr("type", "text");
    } else {
        $('#change-pass-old-password').attr("type", "password");
    }
});
$(".toggle-password-new").click(function () {
    var input = $('#change-pass-new-password').attr("type");
    if (input == "password") {
        $('#change-pass-new-password').attr("type", "text");
    } else {
        $('#change-pass-new-password').attr("type", "password");
    }
});
$(".toggle-password-confirm").click(function () {
    var input = $('#change-pass-confirm-password').attr("type");
    if (input == "password") {
        $('#change-pass-confirm-password').attr("type", "text");
    } else {
        $('#change-pass-confirm-password').attr("type", "password");
    }
});
$(".toggle-signup-password").click(function () {
    var input = $('#signup-password').attr("type");
    if (input == "password") {
        $('#signup-password').attr("type", "text");
    } else {
        $('#signup-password').attr("type", "password");
    }
});
$(".toggle-signup-password-confirm").click(function () {
    var input = $('#signup-confirm-password').attr("type");
    if (input == "password") {
        $('#signup-confirm-password').attr("type", "text");
    } else {
        $('#signup-confirm-password').attr("type", "password");
    }
});