$('.slide-slick').slick({
    centerMode: true,
    centerPadding: '0',
    slidesToShow: 5,
    infinite: true,
    autoplay: true,
    arrows: true,
    speed: 1000,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>"

});


function openVideoModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

function closeVideoModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}