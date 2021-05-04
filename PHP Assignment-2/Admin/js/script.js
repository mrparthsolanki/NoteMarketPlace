$(".toggle-password").click(function () {
    var input = $('#login-password').attr("type");
    if (input == "password") {
        $('#login-password').attr("type", "text");
    } else {
        $('#login-password').attr("type", "password");
    }
});