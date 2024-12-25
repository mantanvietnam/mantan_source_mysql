document.addEventListener("DOMContentLoaded", () => {
  const navItems = document.querySelectorAll(".collection-nav-item");
  const containers = document.querySelectorAll(".collection-container");

  // Thêm sự kiện click cho từng danh mục
  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Xóa class active khỏi tất cả nav items
      navItems.forEach((nav) => nav.classList.remove("active"));
      item.classList.add("active");

      // Lấy giá trị data-target từ nav item
      const targetCategory = item.getAttribute("data-target");

      // Hiển thị cụm dữ liệu tương ứng
      containers.forEach((container) => {
        if (container.getAttribute("data-category") === targetCategory) {
          container.classList.remove("d-none");
        } else {
          container.classList.add("d-none");
        }
      });
    });
  });
});

// Costom slider cho sư kiện
function prevSlide() {
  const carousel = document.querySelector("#carouselExampleIndicators"); // ID của carousel
  const carouselInstance = bootstrap.Carousel.getInstance(carousel);
  carouselInstance.prev(); // Di chuyển về slide trước
}

function nextSlide() {
  const carousel = document.querySelector("#carouselExampleIndicators");
  const carouselInstance = bootstrap.Carousel.getInstance(carousel);
  carouselInstance.next(); // Di chuyển đến slide tiếp theo
}

// nav của tin tức

document.addEventListener("DOMContentLoaded", () => {
  const navItems = document.querySelectorAll(".news-nav-item");
  const containers = document.querySelectorAll(".news-container");

  // Thêm sự kiện click cho từng danh mục
  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Xóa class active khỏi tất cả nav items
      navItems.forEach((nav) => nav.classList.remove("active"));
      item.classList.add("active");

      // Lấy giá trị data-target từ nav item
      const targetCategory = item.getAttribute("data-target");

      // Hiển thị cụm dữ liệu tương ứng
      containers.forEach((container) => {
        if (container.getAttribute("data-category") === targetCategory) {
          container.classList.remove("d-none");
        } else {
          container.classList.add("d-none");
        }
      });
    });
  });
});

// hiệu ứng đẹp
document.addEventListener("DOMContentLoaded", () => {
  const target = document.querySelector(".recommend-intro");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        target.classList.add("visible");
      }
    });
  });

  observer.observe(target);
});

document.addEventListener("DOMContentLoaded", () => {
  const imgContainer = document.querySelector(".recommend-img-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        imgContainer.classList.add("visible");
      }
    });
  });

  observer.observe(imgContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const reviewContainer = document.querySelector(".review-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        reviewContainer.classList.add("visible");
      }
    });
  });

  observer.observe(reviewContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const storyContainer = document.querySelector(".story-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        storyContainer.classList.add("visible");
      }
    });
  });

  observer.observe(storyContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const legitContainer = document.querySelector(".legit-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        legitContainer.classList.add("visible");
      }
    });
  });

  observer.observe(legitContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".container-hint");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".delivary-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".category-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".bestsell-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".instruction-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".container-combo");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".new-collection-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".event-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

document.addEventListener("DOMContentLoaded", () => {
  const guideContainer = document.querySelector(".new-section-container");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        guideContainer.classList.add("visible");
      }
    });
  });

  observer.observe(guideContainer);
});

//tăng giảm số lượng sản phẩm mua
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("increase").addEventListener("click", function () {
    let quantity = document.getElementById("quantity");
    let currentValue = parseInt(quantity.innerText);
    quantity.innerText = currentValue + 1; // Tăng số lượng
  });

  document.getElementById("decrease").addEventListener("click", function () {
    let quantity = document.getElementById("quantity");
    let currentValue = parseInt(quantity.innerText);
    if (currentValue > 1) {
      // Kiểm tra nếu số lượng lớn hơn 1
      quantity.innerText = currentValue - 1; // Giảm số lượng
    }
  });
});

//thanh điều hướng thông tin sản phẩm ở màn chi tiết
document.addEventListener("DOMContentLoaded", () => {
  // Fake API responses with an array of content
  const apiResponses = {
    info: `
      <p class="mt-5"><strong>Thông tin sản phẩm:</strong> Đây là sản phẩm mới với các tính năng vượt trội...</p>
      <img src="../assets/images/slide11.png" alt="Product Image 1" class="mt-5 mb-5 w-full h-[400px] object-cover rounded-[24px]">
      <p>Được thiết kế với công nghệ tiên tiến, mang lại hiệu suất vượt trội.</p>
      <p>Chất liệu cao cấp, bền bỉ và thân thiện với người dùng.</p>
    `,
    specs: `
      <p><strong>Kích thước:</strong> 30x40x10 cm</p>
      <p><strong>Trọng lượng:</strong> 1kg</p>
      <p><strong>Chất liệu:</strong> Nhựa cao cấp</p>
      <img src="../assets/images/slide11.png" alt="Product Image 1" class="mt-5 mb-5 w-full h-[400px] object-cover rounded-[24px]">
    `,
    reviews: `
      <p class="mt-5"><strong>Đánh giá:</strong> Sản phẩm được đánh giá 4.5/5.</p>
      <p>Rất hài lòng về chất lượng, độ bền và thiết kế.</p>
      <img src="../assets/images/slide11.png" alt="Product Image 1" class="mt-5 mb-5 w-full h-[400px] object-cover rounded-[24px]">
      <p class="mt-5">Khách hàng phản hồi tích cực về hiệu suất sản phẩm.</p>
    `,
  };

  // Function to change the content based on button selection
  function changeContent(contentType) {
    const contentDiv = document.getElementById("content");

    // Clear previous content
    contentDiv.innerHTML = "";

    // Inject the HTML content returned from the "API"
    contentDiv.innerHTML = apiResponses[contentType];
  }

  // Add event listeners to the buttons
  document.getElementById("btn-info").addEventListener("click", function () {
    // Activate the button and change content
    setActiveButton("btn-info");
    changeContent("info");
  });

  document.getElementById("btn-specs").addEventListener("click", function () {
    setActiveButton("btn-specs");
    changeContent("specs");
  });

  document.getElementById("btn-reviews").addEventListener("click", function () {
    setActiveButton("btn-reviews");
    changeContent("reviews");
  });

  // Function to set the active button
  function setActiveButton(buttonId) {
    // Remove active class from all buttons
    const buttons = document.querySelectorAll("button");
    buttons.forEach((btn) => {
      btn.classList.remove("bg-blue-900", "text-white", "rounded-full");
      btn.classList.add("text-gray-400");
    });

    // Add active class to clicked button
    const activeButton = document.getElementById(buttonId);
    activeButton.classList.add("bg-blue-900", "text-white", "rounded-full");
    activeButton.classList.remove("text-gray-400");
  }

  // Initialize by showing 'Thông tin sản phẩm' content by default
  changeContent("info");
});

//Xử lý các bước đặt hàng
document.addEventListener("DOMContentLoaded", () => {
  let currentStep = 1; // Bắt đầu từ bước đầu tiên
  const steps = document.querySelectorAll(".step");
  const stepContents = document.querySelectorAll(".step-content");
  const nextButton = document.querySelectorAll("#next-step");

  function updateUI() {
    // Cập nhật trạng thái hiển thị cho các bước
    steps.forEach((step) => {
      const stepNumber = parseInt(step.getAttribute("data-step"));
      const icon = step.querySelector(".icon");

      // Bước đã hoàn thành
      if (stepNumber < currentStep) {
        step.classList.add("completed");
        step.classList.remove("active");
        icon.classList.add("text-white", "bg-blue-900");
        icon.classList.remove("bg-gray-200", "text-gray-500");
      }
      // Bước hiện tại
      else if (stepNumber === currentStep) {
        step.classList.add("active");
        step.classList.remove("completed");
        icon.classList.add("text-white", "bg-blue-900");
        icon.classList.remove("bg-gray-200", "text-gray-500");
      }
      // Bước chưa hoàn thành
      else {
        step.classList.remove("active", "completed");
        icon.classList.add("bg-gray-200", "text-gray-500");
        icon.classList.remove("text-white", "bg-blue-900");
      }
    });

    // Hiển thị nội dung tương ứng với bước hiện tại
    stepContents.forEach((content) => {
      const stepNumber = parseInt(content.getAttribute("data-step"));
      content.classList.toggle("hidden", stepNumber !== currentStep);
    });
  }

  // Xử lý nút "Next Step"
  nextButton.forEach((button) => {
    button.addEventListener("click", () => {
      if (currentStep < steps.length) {
        currentStep++;
        updateUI();
      } else {
        alert("Đặt hàng thành công!");
      }
    });
  });

  // Cập nhật giao diện ban đầu
  updateUI();
});

document.addEventListener("DOMContentLoaded", () => {
  const nextStepButton = document.querySelector(".btn-submit-form");

  nextStepButton.addEventListener("click", () => {
    // Lấy giá trị từ các trường thông tin
    const name = document.querySelector("#name").value;
    const phone = document.querySelector("#phone").value;
    const address = document.querySelector("#address").value;
    const note = document.querySelector("#note").value;

    // Lấy giá trị từ các radio button
    const shipping = document
      .querySelector('input[name="shipping"]:checked')
      ?.nextElementSibling.textContent.trim();
    const payment = document
      .querySelector('input[name="payment"]:checked')
      ?.nextElementSibling.textContent.trim();

    // Tạo object chứa dữ liệu form
    const formData = {
      name,
      phone,
      address,
      note,
      shipping,
      payment,
    };

    // Hiển thị thông tin trong console
    console.log("Thông tin khách hàng:", formData);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const thumbnails = document.querySelectorAll(".thumbnail-image");
  const mainImage = document.getElementById("main-image");

  // Đặt mặc định là ảnh đầu tiên
  thumbnails[0].classList.add("active");

  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", function () {
      // Xóa class 'active' khỏi tất cả các ảnh nhỏ
      thumbnails.forEach((thumb) => thumb.classList.remove("active"));

      // Thêm class 'active' cho ảnh hiện tại
      this.classList.add("active");

      // Đổi ảnh lớn theo ảnh được chọn
      const selectedImage = this.src;
      mainImage.src = selectedImage;
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Thời gian kết thúc (cập nhật theo yêu cầu)
  const countdownDate =
    new Date().getTime() +
    1 * 24 * 60 * 60 * 1000 +
    23 * 60 * 60 * 1000 +
    11 * 60 * 1000 +
    2 * 1000;

  // Các phần tử đếm ngược
  const countNumbers = document.querySelectorAll(".count-number");

  function updateCountdown() {
    const now = new Date().getTime();
    const timeLeft = countdownDate - now;

    if (timeLeft < 0) {
      // Hết thời gian
      clearInterval(interval);
      countNumbers.forEach((num) => (num.textContent = "00"));
      return;
    }

    // Tính toán ngày, giờ, phút, giây
    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    // Cập nhật nội dung
    const values = [
      String(days).padStart(2, "0"),
      String(hours).padStart(2, "0"),
      String(minutes).padStart(2, "0"),
      String(seconds).padStart(2, "0"),
    ];

    countNumbers.forEach((num, index) => {
      num.textContent = values[index];
    });
  }

  // Cập nhật đếm ngược mỗi giây
  const interval = setInterval(updateCountdown, 1000);

  // Gọi lần đầu để hiển thị ngay
  updateCountdown();
});

document.addEventListener("DOMContentLoaded", function () {
  const decrementButton = document.querySelector(".btn-decrement");
  const incrementButton = document.querySelector(".btn-increment");
  const quantityDisplay = document.querySelector(".quantity-display");
  const totalPriceDisplay = document.querySelector(".total-price");
  const unitPrice = 600000; // Giá của mỗi sản phẩm

  // Hàm cập nhật tổng tiền
  function updateTotalPrice(quantity) {
    const totalPrice = unitPrice * quantity;
    totalPriceDisplay.textContent = `${totalPrice.toLocaleString("vi-VN")}đ`;
  }

  // Sự kiện nút trừ (-)
  decrementButton.addEventListener("click", function () {
    let quantity = parseInt(quantityDisplay.textContent.trim(), 10);
    if (quantity > 1) {
      quantity--;
      quantityDisplay.textContent = quantity;
      updateTotalPrice(quantity);
    }
  });

  // Sự kiện nút thêm (+)
  incrementButton.addEventListener("click", function () {
    let quantity = parseInt(quantityDisplay.textContent.trim(), 10);
    quantity++;
    quantityDisplay.textContent = quantity;
    updateTotalPrice(quantity);
  });

  // Cập nhật tổng tiền ban đầu
  updateTotalPrice(parseInt(quantityDisplay.textContent.trim(), 10));
});
