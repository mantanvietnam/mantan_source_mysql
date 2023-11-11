$(document).ready(function() {
    $(".people-comment").on("click", function(){
        $('.box-comment').css("display", "block")
    });

    $(".close-button").on("click", function(){
      $('.box-confirm-cart').css("display", "none")
  });
});


$(document).ready(function(){
  
  $("#modal-cart").modal('show');
  // 
  $('.menu-footer ul').hide();

  $('.footer-menu-name1').on("click", function(){
    $('.menu-footer1 ul').slideToggle();
  });

  $('.footer-menu-name2').on("click", function(){
    $('.menu-footer2 ul').slideToggle();
  });

  
});

(function () {
    let items = document.querySelectorAll('[loop]');
    for (let item of items) {
        let html = item.innerHTML;
        let time = Number(item.getAttribute('loop'))
        for (let i = 0; i < time - 1; i++) {
            item.innerHTML += html;
        }
    }
})();

const percentage = Math.round((value / max) * 100);
document.querySelector('.overlay').style.width = `${100 - percentage}%`;

// input


function increaseValue() {
    var input = document.getElementById("valueInput");
    var currentValue = parseInt(input.value);
    input.value = currentValue + 1;
  }

  function decreaseValue() {
    var input = document.getElementById("valueInput");
    var currentValue = parseInt(input.value);
    if (currentValue > 0) {
      input.value = currentValue - 1;
    }
  }

//   Đổi màu yêu thích
function changeColor() {
    var button = document.querySelector(".product-detail-button-like button");
    button.classList.toggle("change");
  }


//   Đổi màu yêu rate
function changeColorRate() {
    var button = document.querySelector(".product-detail-rate-like > svg");
    button.classList.toggle("changeRate");
}




