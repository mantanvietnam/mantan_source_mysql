$(document).ready(function () {
  let isClicking = false;

  $(".nav-tabs li").click(function (event) {
    event.preventDefault();
    if (isClicking) return;

    isClicking = true;

    $(".tab-content").hide();
    $(".nav-tabs li").removeClass("active");
    $(this).addClass("active");
    let id_tab_content = $(this).children("a").attr("href");
    $(id_tab_content).fadeIn();

    setTimeout(function () {
      isClicking = false;
    }, 500);

    return false;
  });

  $(".qty-count--add").click(function () {
    var currentValue = parseInt($(this).siblings(".product-qty").val());
    var newValue = currentValue + 1;

    if (newValue > 10) {
      newValue = 10;
    }

    $(this).siblings(".product-qty").val(newValue);
  });

  $(".qty-count--minus").click(function () {
    var currentValue = parseInt($(this).siblings(".product-qty").val());
    var newValue = currentValue - 1;

    // Giới hạn giá trị tối thiểu
    if (newValue < 0) {
      newValue = 0;
    }

    $(this).siblings(".product-qty").val(newValue);
  });
});

$(document).ready(function () {
  $("#customer-form").submit(function (event) {
    event.preventDefault();

    if (validateForm()) {
      alert("Form hợp lệ! Dữ liệu sẽ được gửi đi.");
    } else {
      alert("Vui lòng điền đầy đủ thông tin vào các trường bắt buộc.");
    }
  });

  function validateForm() {
    var isValid = true;

    $("#customer-form input[required]").each(function () {
      if ($.trim($(this).val()) == "") {
        isValid = false;
        return false;
      }
    });

    return isValid;
  }

  $(document).ready(function () {
    $(".dropdown-menu a.dropdown-item").click(function () {
      var selectedValue = $(this).data("value"); // Lấy giá trị đã chọn từ thuộc tính data-value
      $("#dropdownMenuButton").text(selectedValue); // Cập nhật nội dung của button dropdown
    });
  });
});

// datepicker
$(document).ready(function() {
  // Chọn đối tượng input để áp dụng Datepicker
  $('#datepicker').datepicker({
      dateFormat: 'dd/mm/yy',  // Định dạng ngày tháng năm (ngày/tháng/năm)
      changeMonth: true,  // Cho phép thay đổi tháng
      changeYear: true    // Cho phép thay đổi năm
  });
});

