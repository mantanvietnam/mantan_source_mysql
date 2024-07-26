//nav bar
$(document).ready(function () {
  let isClicking = false;

  $('.nav-tabs li').click(function(event) {
      event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
      if (isClicking) return;

      isClicking = true;

      // Ẩn tất cả các nội dung tab
      $('.tab-content').hide();
      // Loại bỏ lớp active từ tất cả các tab
      $('.nav-tabs li').removeClass('active');
      // Thêm lớp active vào tab được nhấp
      $(this).addClass('active');
      // Lấy id của nội dung tab cần hiển thị
      let id_tab_content = $(this).children('a').attr('href');
      // Hiển thị nội dung tab tương ứng
      $(id_tab_content).fadeIn();

      setTimeout(function() {
          isClicking = false;
      }, 500); // Điều chỉnh thời gian timeout nếu cần thiết

      return false;
  });
});

//Thay đổi giá trị input
/*$(document).ready(function() {
  $('.qty-count').on('click', function() {
      // Lấy hành động (add hoặc minus) từ thuộc tính data-action
      var action = $(this).data('action');
      
      // Lấy giá trị hiện tại của input số lượng
      var currentValue = parseInt($('.product-qty').val());
      
      // Kiểm tra hành động và thay đổi giá trị
      if (action === 'add') {
          var newValue = currentValue + 1;
      } else if (action === 'minus') {
          var newValue = currentValue - 1;
      }
      
      // Giới hạn giá trị tối đa và tối thiểu
      if (newValue > 10) {
          newValue = 10;
      } else if (newValue < 0) {
          newValue = 0;
      }
      
      // Cập nhật giá trị vào input số lượng
      $('.product-qty').val(newValue);
  });
});*/

//Đến trang mua hàng
/*$(document).ready(function () {
    let isClicking = false;
  
    $('.btn-buy').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        if (isClicking) return;
  
        isClicking = true;
  
        // Ẩn tất cả các nội dung tab
        $('.tab-content').hide();
        // Loại bỏ lớp active từ tất cả các tab
        $('.nav-tabs li').removeClass('active');
        // Thêm lớp active vào tab được nhấp
        $(this).addClass('active');
        // Lấy id của nội dung tab cần hiển thị
        let id_tab_content = $(this).children('a').attr('href');
        // Hiển thị nội dung tab tương ứng
        $(id_tab_content).fadeIn();
  
        setTimeout(function() {
            isClicking = false;
        }, 500); // Điều chỉnh thời gian timeout nếu cần thiết
  
        return false;
    });
  });*/