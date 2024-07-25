
$(document).ready(function () {
    let isClicking = false;

    // Mặc định hiển thị tab đầu tiên khi trang được tải
    $('.nav-tabs li:first-child').addClass('active');
    $('.tab-content-item').hide();
    $('.tab-content-item:first-child').show();

    $('.nav-tabs li').click(function() {
        if (isClicking) return false;

        isClicking = true;

        $('.tab-content-item').hide();
        $('.nav-tabs li').removeClass('active');
        $(this).addClass('active');
        let id_tab_content = $(this).children('a').attr('href');
        $(id_tab_content).fadeIn();

        setTimeout(function() {
            isClicking = false;
        }, 500); // điều chỉnh thời gian chờ nếu cần thiết

        return false;
    });
});

var QtyInput = (function() {
    var $qtyInputs = $(".qty-input");

    if (!$qtyInputs.length) {
        return;
    }

    var $inputs = $qtyInputs.find(".product-qty");
    var $countBtn = $qtyInputs.find(".qty-count");
    var qtyMin = parseInt($inputs.attr("min"));
    var qtyMax = parseInt($inputs.attr("max"));

    $inputs.change(function() {
        var $this = $(this);
        var $minusBtn = $this.siblings(".qty-count--minus");
        var $addBtn = $this.siblings(".qty-count--add");
        var qty = parseInt($this.val());

        if (isNaN(qty) || qty <= qtyMin) {
            $this.val(qtyMin);
            $minusBtn.attr("disabled", true);
        } else {
            $minusBtn.attr("disabled", false);

            if (qty >= qtyMax) {
                $this.val(qtyMax);
                $addBtn.attr('disabled', true);
            } else {
                $this.val(qty);
                $addBtn.attr('disabled', false);
            }
        }
    });

    $countBtn.click(function() {
        var operator = this.dataset.action;
        var $this = $(this);
        var $input = $this.siblings(".product-qty");
        var qty = parseInt($input.val());

        if (operator == "add") {
            qty += 1;
            if (qty >= qtyMin + 1) {
                $this.siblings(".qty-count--minus").attr("disabled", false);
            }

            if (qty >= qtyMax) {
                $this.attr("disabled", true);
            }
        } else {
            qty = qty <= qtyMin ? qtyMin : (qty -= 1);

            if (qty == qtyMin) {
                $this.attr("disabled", true);
            }

            if (qty < qtyMax) {
                $this.siblings(".qty-count--add").attr("disabled", false);
            }
        }

        $input.val(qty);
    });
})();

// datepicker
$(document).ready(function() {
    // Chọn đối tượng input để áp dụng Datepicker
    $('#datepicker').datepicker({
        dateFormat: 'dd/mm/yy',  // Định dạng ngày tháng năm (ngày/tháng/năm)
        changeMonth: true,  // Cho phép thay đổi tháng
        changeYear: true    // Cho phép thay đổi năm
    });
});
