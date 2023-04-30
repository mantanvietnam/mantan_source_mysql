/*
$(document).ready(function () {
    $("div").click(function (e) {
        let div_class = $(this).attr("class")
        if (div_class == "showView") {
            var activeElement = $(this).find('.active-hover');
            $("#list-selection-choose").remove();
            
            var typeLayer = activeElement.data('type');
            let idProduct = activeElement.data('idproduct'); // id sản phẩm
            let idLayer = activeElement.data('id'); // id layer

            if(typeLayer=='text'){
                $(activeElement).append( //html
                    `
                    <div id="list-selection-choose">
                        <button class='btn-style-design-delete' onclick="deletedinlayer(`+idProduct+`,`+idLayer+`)">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        <button class='btn-style-design-copy'>
                            <i class="fa-solid fa-copy"></i>
                        </button>
                        <button class='btn-style-design-edit' onclick="showFormEditText(`+idLayer+`);">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                    `
                );
            }else if(typeLayer=='image'){

            }
        }
    });
});
*/