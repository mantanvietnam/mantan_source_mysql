$(document).ready(function () {
    console.log("Long Js");
    $("div").click(function (e) {
        let div_class = $(this).attr("class")
        if (div_class == "showView") {
            var activeElement = $(this).find('.active-hover');
            $("#btn-delete-design").remove();
            $(activeElement).append( //html
                `<button id='btn-delete-design'>
                <i class="fa-solid fa-trash-can"></i>
                </button>`
            );
            $("#btn-delete-design").css({
                "position": "absolute",
                "bottom": "100%",
                "left": "0px",
                "border": "none",
                "background": "white",
                "width": "40px",
                "height": "40px",
                "border-radius": "50%",
                "color": "black",
                "font-size": "17px",
                "margin-bottom": "10px"
            });
            
        }
    });
});