
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
  arrows: false
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






