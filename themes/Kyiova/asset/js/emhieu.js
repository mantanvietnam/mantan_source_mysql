$('.produce-img-nav').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    asNavFor: '.produce-img-for'
});
$('.produce-img-for').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.produce-img-nav',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: false,

});


function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
}

function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

$('.list-produce-other').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    focusOnSelect: true,
    arrows: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 1
            }
        },

    ]

});



// Tăng giảm số lượng sản phẩm trang GIỎ HÀNG

var eventFired = false;

function adjustQuantity(productId, delta) {
    if (!eventFired) {
        var quantityInput = document.getElementById('quantity_' + productId);
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + delta;

        newQuantity = Math.min(Math.max(newQuantity, 1), 99);
        quantityInput.value = newQuantity;
        eventFired = true;
    }
}

document.querySelectorAll('.quantity-input').forEach(function(input) {
    var productId = input.getAttribute('data-quantity');

    input.querySelector('.quantity-btn:first-child').addEventListener('click', function() {
        adjustQuantity(productId, -1);
        eventFired = false;
    });

    input.querySelector('.quantity-btn:last-child').addEventListener('click', function() {
        adjustQuantity(productId, 1);
        eventFired = false;
    });
});



// Layout TÌM KIẾM 

document.querySelector('.search-btn').addEventListener('click', function() {
    // Hiển thị overlay
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'flex';

    // Thêm lớp chống cuộn vào body
    document.body.classList.add('scroll-lock');
});

function closeOverlay() {
    // Ẩn overlay
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'none';

    // Loại bỏ lớp chống cuộn từ body
    document.body.classList.remove('scroll-lock');
}