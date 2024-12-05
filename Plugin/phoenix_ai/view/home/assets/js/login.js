$(document).ready(function () {
    $(".toggle-password").click(function () {
        // Đổi icon
        if ($(this).hasClass("fa-eye")) {
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        }

        // Đổi loại input
        var input = $($(this).attr("toggle"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});
