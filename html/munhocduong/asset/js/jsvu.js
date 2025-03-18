document.addEventListener("DOMContentLoaded", function() {
    const btn = document.querySelector(".btn-outline-warning");
    btn.addEventListener("click", function() {
        alert("Bạn đã nhấn vào nút TÌM HIỂU NGAY!");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const swiper = document.querySelector(".mySwiper");
    
    if (swiper) {
      swiper.setAttribute("autoplay", "{ delay: 3000, disableOnInteraction: false }");
    }
  });


  var swiper = new Swiper(".swiper", {
    slidesPerView: "auto",
    spaceBetween: 20,
    navigation: {
        nextEl: ".next",
        prevEl: ".prev",
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const swiperEl = document.querySelector(".product-slider");
    Object.assign(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 10,
      navigation: true,
      pagination: { clickable: true },
      breakpoints: {
        640: { slidesPerView: 2, spaceBetween: 20 },
        768: { slidesPerView: 3, spaceBetween: 30 },
        1024: { slidesPerView: 4, spaceBetween: 40 },
      },
    });
    swiperEl.initialize();
  });



document.addEventListener('DOMContentLoaded', function() {
  // Image Gallery Functionality
  const thumbnails = document.querySelectorAll('.thumbnail-item');
  const mainImages = document.querySelectorAll('.main-image');
  
  thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', function() {
          // Get the index of the clicked thumbnail
          const index = this.getAttribute('data-index');
          
          // Remove active class from all thumbnails and main images
          thumbnails.forEach(item => item.classList.remove('active'));
          mainImages.forEach(image => image.classList.remove('active'));
          
          // Add active class to the clicked thumbnail and corresponding main image
          this.classList.add('active');
          mainImages[index].classList.add('active');
      });
  });
  
  // Quantity Controls
  const minusBtn = document.querySelector('.quantity-btn.minus');
  const plusBtn = document.querySelector('.quantity-btn.plus');
  const quantityInput = document.querySelector('.quantity-input');
  
  // Decrement quantity
  minusBtn.addEventListener('click', function() {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue > 1) {
          quantityInput.value = currentValue - 1;
      }
  });
  
  // Increment quantity
  plusBtn.addEventListener('click', function() {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue < 99) {
          quantityInput.valuequantityInput.value = currentValue + 1;
        }
    });

    // Ensure input value stays within limits
    quantityInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
            this.value = 1;
        } else if (value > 99) {
            this.value = 99;
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
  let currentStep = 1;

  document.querySelectorAll("#next-step").forEach(button => {
      button.addEventListener("click", function () {
          document.querySelector(`[data-step="${currentStep}"]`).classList.add("d-none");
          currentStep++;
          document.querySelector(`[data-step="${currentStep}"]`).classList.remove("d-none");
      });
  });

  document.getElementById("reset-step").addEventListener("click", function () {
      document.querySelector(`[data-step="3"]`).classList.add("d-none");
      currentStep = 1;
      document.querySelector(`[data-step="1"]`).classList.remove("d-none");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper("#sponsorSlider", {
    slidesPerView: 4,
    centeredSlides: true,
    spaceBetween: 30,
    grabCursor: true,
    loop: true,
    autoplay: {
      delay: 3000, // 3 giây
      disableOnInteraction: false, // Tiếp tục chạy sau khi tương tác
    },
    breakpoints: {
      0: {
        slidesPerView: 2, // Hiển thị 2 hình trên màn mobile
        spaceBetween: 15, // Khoảng cách giữa các slide nhỏ hơn
      },
      768: {
        slidesPerView: 3, // Tablet hiển thị 3 hình
      },
      1024: {
        slidesPerView: 4, // Desktop hiển thị 4 hình
      }
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các sản phẩm trong giỏ hàng
  document.querySelectorAll(".cart-item").forEach((cartItem) => {
    let quantityInput = cartItem.querySelector(".product-quantity");
    let decreaseBtn = cartItem.querySelector(".btn-decrease");
    let increaseBtn = cartItem.querySelector(".btn-increase");
    let totalPriceElement = cartItem.querySelector(".total-price");
    let itemPrice = 600000; // Giá sản phẩm mặc định

    // Hàm cập nhật tổng tiền từng sản phẩm
    function updateTotalPrice() {
      let quantity = parseInt(quantityInput.value);
      let totalPrice = itemPrice * quantity;
      totalPriceElement.textContent = totalPrice.toLocaleString("vi-VN") + "đ";
      updateFinalTotal(); // Cập nhật tổng tiền của giỏ hàng
    }

    // Xử lý khi bấm nút giảm
    decreaseBtn.addEventListener("click", function () {
      let quantity = parseInt(quantityInput.value);
      if (quantity > 1) {
        quantityInput.value = quantity - 1;
        updateTotalPrice();
      }
    });

    // Xử lý khi bấm nút tăng
    increaseBtn.addEventListener("click", function () {
      let quantity = parseInt(quantityInput.value);
      quantityInput.value = quantity + 1;
      updateTotalPrice();
    });

    updateTotalPrice(); // Cập nhật giá ngay khi load trang
  });

  // Hàm cập nhật tổng tiền toàn bộ giỏ hàng
  function updateFinalTotal() {
    let finalTotal = 0;
    document.querySelectorAll(".total-price").forEach((item) => {
      finalTotal += parseInt(item.textContent.replace(/\D/g, ""));
    });
    document.getElementById("final-total").textContent =
      finalTotal.toLocaleString("vi-VN") + "đ";
  }
});


document.addEventListener("DOMContentLoaded", function () {
  // Xử lý chuyển đổi hình ảnh khi click vào thumbnail
  const thumbnails = document.querySelectorAll(".thumbnail-item");
  const mainImages = document.querySelectorAll(".main-image");

  thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener("click", function () {
      // Xóa active khỏi tất cả thumbnail
      thumbnails.forEach((thumb) => thumb.classList.remove("active"));

      // Thêm active cho thumbnail được chọn
      thumbnail.classList.add("active");

      // Ẩn tất cả ảnh chính
      mainImages.forEach((img) => img.classList.remove("active"));

      // Hiện ảnh chính tương ứng với thumbnail
      mainImages[index].classList.add("active");
    });
  });

  // Xử lý tăng/giảm số lượng sản phẩm
  const minusBtn = document.querySelector(".quantity-btn.minus");
  const plusBtn = document.querySelector(".quantity-btn.plus");
  const quantityInput = document.querySelector(".quantity-input");

  minusBtn.addEventListener("click", function () {
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
      quantityInput.value = quantity - 1;
    }
  });

  plusBtn.addEventListener("click", function () {
    let quantity = parseInt(quantityInput.value);
    if (quantity < 99) {
      quantityInput.value = quantity + 1;
    }
  });
});
