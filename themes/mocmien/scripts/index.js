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
      <p><strong>Thông tin sản phẩm:</strong> Đây là sản phẩm mới với các tính năng vượt trội...</p>
      <img src="../assets/images/trisacto.png" alt="Product Image 1" class="mt-2 w-full h-[400px] object-cover rounded-lg">
      <p>Được thiết kế với công nghệ tiên tiến, mang lại hiệu suất vượt trội.</p>
      <p>Chất liệu cao cấp, bền bỉ và thân thiện với người dùng.</p>
    `,
    specs: `
      <p><strong>Kích thước:</strong> 30x40x10 cm</p>
      <p><strong>Trọng lượng:</strong> 1kg</p>
      <p><strong>Chất liệu:</strong> Nhựa cao cấp</p>
      <img src="/assets/images/specs1.jpg" alt="Specs Image" class="mt-2 w-full h-auto rounded-lg">
    `,
    reviews: `
      <p><strong>Đánh giá:</strong> Sản phẩm được đánh giá 4.5/5.</p>
      <p>Rất hài lòng về chất lượng, độ bền và thiết kế.</p>
      <img src="/assets/images/review1.jpg" alt="Review Image" class="mt-2 w-full h-auto rounded-lg">
      <p>Khách hàng phản hồi tích cực về hiệu suất sản phẩm.</p>
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
