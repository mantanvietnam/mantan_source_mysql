$(document).ready(function () {
    let isClicking = false;
 
    $('.nav-tabs li').click(function() {
        if (isClicking) return false;
 
        isClicking = true;
 
        $('.tab-content-item').hide();
        $('.tab-content-item:first-child').fadeIn();
        $('.nav-tabs li').removeClass('active');
        $(this).addClass('active');
        let id_tab_content = $(this).children('a').attr('href');
        $('.tab-content-item').hide();
        $(id_tab_content).fadeIn();
 
        setTimeout(function() {
            isClicking = false;
        }, 500); // adjust the timeout as necessary
 
        return false;
    }); 
 });

//   document.getElementById("imageLink").addEventListener("click", function(event) {
//     event.preventDefault();
//     document.getElementById("popupContainer").style.display = "block";
// });

// function closePopup() {
//     document.getElementById("popupContainer").style.display = "none";
// }
/*
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
})();*/