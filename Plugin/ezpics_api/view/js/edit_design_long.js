$(document).ready(function () {
    console.log("Long Js");
    $("div").click(function (e) {
        let div_class = $(this).attr("class")
        if (div_class == "showView") {
            var activeElement = $(this).find('.active-hover');
            $("#list-selection-choose").remove();
            $(activeElement).append( //html
                `
                <div id="list-selection-choose">
                    <button class='btn-style-design-delete'>
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    <button class='btn-style-design-copy'>
                        <i class="fa-solid fa-copy"></i>
                    </button>
                    <button class='btn-style-design-edit'>
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
                `
            );
        }
    });
});