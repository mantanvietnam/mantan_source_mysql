$ = jQuery;


// Select all elements with the "i" tag and store them in a NodeList called "stars"
const stars = document.querySelectorAll(".stars i");

// Loop through the "stars" NodeList
stars.forEach((star, index1) => {
    // Add an event listener that runs a function when the "click" event is triggered
    star.addEventListener("click", () => {
        // Loop through the "stars" NodeList Again
        stars.forEach((star, index2) => {
            // Add the "active" class to the clicked star and any stars with a lower index
            // and remove the "active" class from any stars with a higher index
            index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
        });
    });
});


$(document).ready(function () {
    $(".write-comment-content").hide();
    $(".button-write-comment").click(function () {
        $(".write-comment-content").slideToggle();
    });
    $(".eye-icon").click(function (e) {
        let value = $(this).attr("value")

        var $inputField = $(this).parent().siblings('input');

        if (value == "open") {
            $(this).attr("src", "/themes/tayho360/img/eyeclose.png")
            $(this).attr("value", "close")
            $inputField.attr("type", "password")
        } else {
            $(this).attr("src", "/themes/tayho360/img/eyeopen.png")
            $(this).attr("value", "open")
            $inputField.attr("type", "text")
        }

    });

});


// mã xác nhận
const form = document.querySelector('.form-verify')
if ($(".form-verify").length > 0) {
    const inputs = form.querySelectorAll('.input-verify')
    form.addEventListener('input', handleInput)

    const KEYBOARDS = {
        backspace: 8,
        arrowLeft: 37,
        arrowRight: 39,
    }

    inputs[0].addEventListener('paste', handlePaste)

    inputs.forEach(input => {
        input.addEventListener('focus', e => {
            setTimeout(() => {
                e.target.select()
            }, 0)
        })

        input.addEventListener('keydown', e => {
            switch (e.keyCode) {
                case KEYBOARDS.backspace:
                    handleBackspace(e)
                    break
                case KEYBOARDS.arrowLeft:
                    handleArrowLeft(e)
                    break
                case KEYBOARDS.arrowRight:
                    handleArrowRight(e)
                    break
                default:
            }
        })
    })
}


function handleInput(e) {
    const input = e.target
    const nextInput = input.nextElementSibling
    if (nextInput && input.value) {
        nextInput.focus()
        if (nextInput.value) {
            nextInput.select()
        }
    }
}

function handlePaste(e) {
    e.preventDefault()
    const paste = e.clipboardData.getData('text')
    inputs.forEach((input, i) => {
        input.value = paste[i] || ''
    })
}

function handleBackspace(e) {
    const input = e.target
    if (input.value) {
        input.value = ''
        return
    }

    input.previousElementSibling.focus()
}

function handleArrowLeft(e) {
    const previousInput = e.target.previousElementSibling
    if (!previousInput) return
    previousInput.focus()
}

function handleArrowRight(e) {
    const nextInput = e.target.nextElementSibling
    if (!nextInput) return
    nextInput.focus()
}


// button
$(document).ready(function () {
    $('#place-detail .button-content button').click(function () {
        if ($('#place-detail .button-like button ').css('background-color') == 'rgba(0, 0, 0, 0)') {
            $('#place-detail .button-like button').css('background-color', '#188181');
            $('#place-detail .button-like button').css('color', '#fff')
            $('.button-like i').css('color', '#fff');
        } else {
            $('#place-detail .button-like button').css('background-color', 'transparent');
            $('#place-detail .button-like button').css('color', '#188181')
            $('.button-like i').css('color', '#188181');
        }
    });

   

    
});

// xem thêm

$(function () {
    var limitW = 200;
    var char = 4;

    var txtEle = $('.post-comment-content-text')
    if (txtEle.length > 0) {
        var txt = $('.post-comment-content-text').html();
        var txtStart = txt.slice(0, limitW).replace(/\w+$/, '');
        var txtEnd = txt.slice(txtStart.length);
        if (txtEnd.replace(/\s+$/, '').split(' ').length > char) {
            $('.post-comment-content-text').html([
                    txtStart,
                    '<a href="#" class="more">... xem thêm</a>',
                    '<span class="detail">',
                    txtEnd,
                    '</span>'
                ].join('')
            );
        }

        $('span.detail').hide();
        $('a.more').click(function () {
            $(this).hide().next('span.detail').fadeIn();
            return false;
        });
    }
});


// chi tiet dia diem
// $(function () {
//     var limitW = 400;
//     var char = 5;
//     var txtEle = $('.content-information')
//     if (txtEle.length > 0) {
//         var txt = $('.content-information').html();
//         console.log(txt);
//         var txtStart = txt.slice(0, limitW).replace(/\w+$/, '');
//         var txtEnd = txt.slice(txtStart.length);
//         if (txtEnd.replace(/\s+$/, '').split(' ').length > char) {
//             $('.content-information').html([
//                     txtStart,
//                     '<a href="#" class="more">... xem thêm</a>',
//                     '<span class="detail">',
//                     txtEnd,
//                     '</span>'
//                 ].join('')
//             );
//         }

//         $('span.detail').hide();
//         $('a.more').click(function () {
//             $(this).hide().next('span.detail').fadeIn();
//             return false;
//         });
//     }
// });

jQuery= $;
$(document).ready(function(){
  $("#booking-tabs .box-search label input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".tab-content-booking tr").filter(function() {
        $(".tab-content-booking tr:first-child()").show();
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});



// $(document).ready(function() {
//     var content = $(".content-information");
//     var maxHeight = 100; // Chiều cao tối đa của nội dung (đơn vị là pixel)
//     var contentHeight = content[0].scrollHeight; // Chiều cao thực tế của nội dung

//     if (contentHeight > maxHeight) {
//       content.css("max-height", maxHeight + "px");
//       $("<div>", {
//         "class": "more",
//         text: "Xem thêm"
//       }).appendTo(content).show();
//     }

//     content.on("click", ".more", function() {
//       if (content.hasClass("expanded")) {
//         content.animate({
//           "max-height": maxHeight + "px"
//         });
//         content.removeClass("expanded");
//         $(this).text("Xem thêm");
//       } else {
//         content.animate({
//           "max-height": contentHeight + "px"
//         });
//         content.addClass("expanded");
//         $(this).text("Ẩn bớt");
//       }
//     });
//   });

$(function () {
    var limitW = 200;
    var char = 4;

    var txtEle = $('.content-information')
    if (txtEle.length > 0) {
        var txt = $('.content-information').html();
        var txtStart = txt.slice(0, limitW).replace(/\w+$/, '');
        var txtEnd = txt.slice(txtStart.length);
        if (txtEnd.replace(/\s+$/, '').split(' ').length > char) {
            $('.content-information').html([
                    txtStart,
                    '<a href="#" class="more">... xem thêm</a>',
                    '<span class="detail">',
                    txtEnd,
                    '</span>'
                ].join('')
            );
        }

        $('span.detail').hide();
        $('a.more').click(function () {
            $(this).hide().next('span.detail').fadeIn();
            return false;
        });
    }
});

