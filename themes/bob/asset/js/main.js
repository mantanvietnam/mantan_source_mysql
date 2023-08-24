$(document).ready(function() {
    // Độ cao tối thiểu để thay đổi màu
    var scrollHeight = 200;

    // Lắng nghe sự kiện scroll của cửa sổ
    $(window).scroll(function() {
        // Lấy vị trí hiện tại khi cuộn
        var scrollY = $(this).scrollTop();

        // Kiểm tra nếu cuộn đủ độ cao cố định, thay đổi màu sắc
        if (scrollY >= scrollHeight) {
            $("#menu").css("background-color", "#f00"); // Thay đổi màu sắc tại đây
        } else {
            $("#menu").css("background-color", "#ccc"); // Màu sắc mặc định
        }
    });

    // search
    $('#section-search').hide();
    $(".menu-header-right .icon-glass").click(function(){
        console.log('a');
        $('#section-search').fadeToggle();
    });

});