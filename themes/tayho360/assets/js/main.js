$(document).ready(function () {
    $('.su-kien-slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: false,
        nextArrow: false,
        autoplay: true,
        autoplaySpeed: 1000
    });
    $('.su-kien-slider-chi-tiet').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 1000,
        prevArrow: "<button type='button' class='slick-prev'><img src='../assets/lou_icon/prev-btn.svg'/></button>",
        nextArrow: "<button type='button' class='slick-next'><img src='../assets/lou_icon/next-btn.svg'/></button>",
    });
    $(".edit-photo").click(function (e) {
        $(".file-edit-img")[0].click()
        // console.log(1);
    });
    $(".switch").click(function (e) {
        $(this).find("div").toggleClass("off")
    });



    // Tăng giảm input
    $('.plus-btn').click(function () {
        var inputEl = $(this).parent().find('input[type="number"]');
        inputEl.val(parseInt(inputEl.val()) + 1);
    });

    $('.minus-btn').click(function () {
        var inputEl = $(this).parent().find('input[type="number"]');
        if (inputEl.val() > 0) {
            inputEl.val(parseInt(inputEl.val()) - 1);
        }
    });

    $(".heart").click(function (e) {
        let src = $(this).attr("src")
        if (src == "../assets/lou_icon/icon-heart.svg") {
            $(this).attr("src", "../assets/lou_icon/icon-heart-white.svg")
        } else {
            $(this).attr("src", "../assets/lou_icon/icon-heart.svg")
        }
    });


    $(".eye-password").click(function () {
        var input = $(this).prev("input");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            $(this).attr("value", "show");
            $(this).attr("src","../assets/lou_icon/icon-eye-open.svg")
        } else {
            input.attr("type", "password");
            $(this).attr("value", "hiden");
            $(this).attr("src","../assets/lou_icon/icon-eye.svg")
        }
    });
});