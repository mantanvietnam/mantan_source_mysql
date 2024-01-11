$('.icon-close').hide();
document.getElementById('button-contact-2').addEventListener('click', function() {
  $('.icon-phone-bottom').toggle();
  $('.icon-close').toggle();
  this.classList.toggle('active');
  var content = $('.content-contact-2');
  content.style.animation = 'none';
  content.offsetHeight; /* Trigger reflow */
  content.style.animation = null;
});


// voucher disable
$(document).ready(function() {
  $(".voucher-disabled .form-check-input ").prop("disabled", true);;

});



// password hide show
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("pass");
  var toggleIcon = document.querySelector(".toggle-password i");

  // Kiểm tra loại của input để chuyển đổi giữa password và text
  var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Thay đổi icon
  if (type === "password") {
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}




// scroll-top
var btn = $('#button-scrolltop');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


document.getElementById('button-contact').addEventListener('click', function() {
  this.classList.toggle('active');
  var content = $('.content-contact');
  content.style.animation = 'none';
  content.offsetHeight; /* Trigger reflow */
  content.style.animation = null;
});






$(document).on('click', function (e) {
  $(document).ready(function(){
    // Sử dụng sự kiện click cho tất cả các radio button có class 'radioOption'
    $(".check-voucher .checkcode3").click(function(){
        // Bỏ chọn tất cả các radio button trong nhóm có tên 'group1'
        $("input[name='code3']").prop('checked', !$(this).prop('checked'));
    });

    $(".check-voucher .checkcode1").click(function(){
      // Bỏ chọn tất cả các radio button trong nhóm có tên 'group1'
      $("input[name='code1']").prop('checked', !$(this).prop('checked'));
    });

    $(".check-voucher .checkcode2").click(function(){
      // Bỏ chọn tất cả các radio button trong nhóm có tên 'group1'
      $("input[name='code2']").prop('checked', !$(this).prop('checked'));
    });
  });


  // Nếu sự kiện click xảy ra ngoài modal content và không phải là nút đóng modal
  if (!$(e.target).closest('#exampleModalcode .modal-content').length && $('#exampleModalcode').is(":visible")) {
      // Ẩn modal bằng ID của modal
      location.reload(); // hoặc location.reload(true);

  }

  if (!$(e.target).closest('#exampleModalpassword .modal-content').length && $('#exampleModalpassword').is(":visible")) {
    // Ẩn modal bằng ID của modal
    location.reload(); // hoặc location.reload(true);

}
if (!$(e.target).closest('#modalemailSubscribe .modal-content').length && $('#modalemailSubscribe').is(":visible")) {
    // Ẩn modal bằng ID của modal
    location.reload(); // hoặc location.reload(true);
}

$("#modalemailSubscribe .btn-close").click(function(){
    location.reload(); // hoặc location.reload(true);
});

  

});


// document.addEventListener('DOMContentLoaded', function() {
//   var voucherDiv = document.querySelector('.voucher-disabled .detail-voucher');
//   var myCheckbox = voucherDiv.querySelector('.form-check-input');
//   myCheckbox.disabled = true;
// });


$('.slide-rate-image').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  // autoplay: true,
  autoplaySpeed: 3000,
  arrows: true,
  prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
  nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
});


var tocList = document.getElementById('toc-list');
var headings = document.querySelectorAll('.blog-detail-content h1,.blog-detail-content h2,.blog-detail-content h3,.blog-detail-content h4,.blog-detail-content h5,.blog-detail-content h6');
headings.forEach(function (heading, index) {
    var link = document.createElement('a');
    link.textContent = heading.textContent;
    link.href = '#' + heading.textContent.replace(/ /g, '-');
    link.addEventListener('click', function () {
        heading.scrollIntoView();
    });

    var listItem = document.createElement('li');
    listItem.appendChild(link);

    // Đánh số mục lục
    var tocNumber = document.createElement('span');
    tocNumber.className = 'toc-number';
    tocNumber.textContent = (index + 1) + '.';
    listItem.insertBefore(tocNumber, listItem.firstChild);

    tocList.appendChild(listItem);
});


// Chi tiết sản phẩm

var contentMain = document.querySelector('.describe-description-filter');
contentMain.classList.add('hideContent');

document.querySelectorAll(".describe-more button").forEach(function(link) {
  link.addEventListener("click", function() {
    // var content = this.parentElement.previousElementSibling;
    var linkText = this.textContent.toUpperCase();

    if (linkText === "XEM THÊM") {
      linkText = "Rút gọn";
      contentMain.classList.remove("hideContent");
      contentMain.classList.add("showContent");
    } else {
      linkText = "Xem thêm";
      contentMain.classList.remove("showContent");
      contentMain.classList.add("hideContent");
    }

    this.textContent = linkText;
  });
});   

 // Sử dụng jQuery để thực hiện toggle khi nút được click
 $(document).ready(function(){
    if ($(window).width() <= 450) {
      $('.info-col-description').hide();

    }

    $(".info-col-left .title-info-col").click(function(){
      if ($(window).width() <= 450) {
          $(".info-col-left .info-col-description").slideToggle();
      }
    });

    $(".info-col-right .title-info-col").click(function(){
      if ($(window).width() <= 450) {
        $(".info-col-right .info-col-description").slideToggle();
      }
    });

    
});


// Top


// Ẩn comment
var listContainer = document.querySelector('.product-detail-rate-list');
var items = listContainer.querySelectorAll('.product-detail-rate-item');
var isExpanded = false;

// Ẩn tất cả phần tử trừ 3 phần tử đầu tiên
for (var i = 7; i < items.length; i++) {
  items[i].classList.add('hidden');
}

function loadMore() {
  if (!isExpanded) {
    // Loại bỏ lớp 'hidden' từ tất cả các phần tử nếu chúng đã được ẩn
    items.forEach(function (item) {
      item.classList.remove('hidden');
    });
    isExpanded = true;
    document.getElementById('toggle-btn').textContent = 'Rút gọn';
  } else {
    // Ẩn bớt các phần tử sau 3 phần tử đầu tiên
    for (var i = 3; i < items.length; i++) {
      items[i].classList.add('hidden');
    }
    isExpanded = false;
    document.getElementById('toggle-btn').textContent = 'Xem thêm  >>';
  }
}











