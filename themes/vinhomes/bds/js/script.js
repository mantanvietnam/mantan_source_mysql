// trang index
//tìm kiếm ở header
document.addEventListener("DOMContentLoaded", () => {
  const searchButton = document.getElementById("searchButton");
  const searchInput = document.getElementById("searchInput");

  // Hàm xử lý tìm kiếm
  const handleSearch = () => {
    const searchValue = searchInput.value.trim(); // Lấy giá trị từ ô input
    console.log(`Từ khóa tìm kiếm: ${searchValue}`);
  };

  // Xử lý sự kiện nhấn nút tìm kiếm
  searchButton.addEventListener("click", handleSearch);

  // Xử lý sự kiện nhấn phím Enter
  searchInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      e.preventDefault(); // Ngăn form gửi đi nếu có
      handleSearch();
    }
  });
});

//Chọn loại nhà
document.addEventListener("DOMContentLoaded", () => {
  // Lấy tất cả các nút thuộc lớp 'property-button'
  const buttons = document.querySelectorAll(".property-button");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Xóa lớp 'active' khỏi tất cả các nút
      buttons.forEach((btn) => btn.classList.remove("active"));

      // Thêm lớp 'active' vào nút được chọn
      button.classList.add("active");
    });
  });
});

//Bộ lọc tìm kiếm ở header
document.addEventListener("DOMContentLoaded", () => {
  // Lấy tất cả các select
  const selects = document.querySelectorAll("select");

  selects.forEach((select) => {
    // Sự kiện change để xử lý giá trị đã chọn
    select.addEventListener("change", (e) => {
      const selectedValue = e.target.value;
      const selectedText = e.target.options[e.target.selectedIndex].text;

      if (selectedValue !== "default") {
        console.log(`Bạn đã chọn: ${selectedText} (Value: ${selectedValue})`);
      }
    });
  });
});

//ẩn hiện thanh nav
document.addEventListener("DOMContentLoaded", () => {
  const dashboardButton = document.getElementById("dashboardButton");
  const sideNav = document.getElementById("sideNav");
  const overlay = document.getElementById("overlay");

  // Khi nhấn nút "Dashboard", hiển thị thanh Nav
  dashboardButton.addEventListener("click", () => {
    sideNav.classList.toggle("open");
    overlay.classList.toggle("active");
  });

  // Khi click vào overlay (vùng ngoài), đóng thanh Nav
  overlay.addEventListener("click", () => {
    sideNav.classList.remove("open");
    overlay.classList.remove("active");
  });
});

//bộ lọc tìm kiếm dự án ở màn danh sách dự án
document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("searchButtonProject")
    .addEventListener("click", () => {
      const fields = document.querySelectorAll(".form-field");
      const values = {};
      let isValid = true;

      fields.forEach((field, index) => {
        const value = field.value.trim();
        if (!value) {
          // Kiểm tra nếu giá trị là mặc định hoặc trống
          console.log(`Field ${index + 1} is invalid (default or empty).`);
          isValid = "Default";
        }
        values[`Field ${index + 1}`] = value || "Default";
      });

      if (isValid) {
        console.log("Valid Input:", values);
      }
    });
});

//slide ảnh
document.addEventListener("DOMContentLoaded", () => {
  var swiper = new Swiper(".mySwiper-image", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  // Show the modal when "Xem tất cả ảnh" button is clicked
  document.getElementById("viewAllBtn").addEventListener("click", () => {
    document.getElementById("imageModal").classList.remove("hidden");
    document.getElementById("imageModal").setAttribute("aria-hidden", "false");
  });

  // Close the modal
  document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("imageModal").classList.add("hidden");
    document.getElementById("imageModal").setAttribute("aria-hidden", "true");
  });
});

//run gon + doc them ở trang chi tiet du an
document.addEventListener("DOMContentLoaded", () => {
  // Lấy tất cả các nút toggle-content
  document.querySelectorAll(".toggle-content button").forEach((button) => {
    button.addEventListener("click", function () {
      // Lấy section liên quan
      const section = this.closest(".section");
      const content = section.querySelector(".content");
      const title = section.getAttribute("data-section");

      // Kiểm tra trạng thái hiển thị
      if (this.dataset.expanded === "true") {
        content.classList.add("hidden");
        this.innerHTML = `
          <span class="text-[#142a72]"> Đọc thêm +</span>
        `;
        this.dataset.expanded = "false";

        // Cập nhật màu nền nếu cần
        section
          .querySelector(".toggle-content > div")
          .classList.remove("bg-[#FFFAF1]");
        section
          .querySelector(".toggle-content > div")
          .classList.add("bg-[#F1F5F9]");
      } else {
        content.classList.remove("hidden");
        this.innerHTML = `
          <span class="text-orange-500">Rút gọn −</span>
        `;
        this.dataset.expanded = "true";

        // Cập nhật màu nền nếu cần
        section
          .querySelector(".toggle-content > div")
          .classList.remove("bg-[#F1F5F9]");
        section
          .querySelector(".toggle-content > div")
          .classList.add("bg-[#FFFAF1]");
      }
    });
  });
});

//Đăng ký tư vấn ở màn chi tiết dự án
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("consultation-form");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Ngừng gửi form

    // Lấy giá trị các trường input
    const fullName = document.getElementById("full-name").value;
    const phoneNumber = document.getElementById("phone-number").value;

    // Console log giá trị của các trường
    console.log("Họ và tên:", fullName);
    console.log("Số điện thoại:", phoneNumber);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollTrigger);

  // Fade-in effect
  gsap.utils.toArray(".fade-in").forEach((el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 80%", // Bắt đầu khi phần tử vào 80% viewport
        toggleActions: "play none none none", // Chạy hiệu ứng một lần
      },
      opacity: 0, // Bắt đầu với opacity 0
      duration: 1.2, // Thời gian hiệu ứng
      ease: "power3.out", // Hiệu ứng mượt mà
    });
  });

  // Slide top effect
  gsap.utils.toArray(".slide-top").forEach((el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 80%", // Bắt đầu khi phần tử vào 80% viewport
        toggleActions: "play none none none", // Chạy hiệu ứng một lần
      },
      y: -50, // Di chuyển phần tử lên
      opacity: 0, // Bắt đầu với opacity 0
      duration: 1.2,
      ease: "power3.out",
    });
  });

  // Slide bottom effect
  gsap.utils.toArray(".slide-bottom").forEach((el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 80%", // Bắt đầu khi phần tử vào 80% viewport
        toggleActions: "play none none none", // Chạy hiệu ứng một lần
      },
      y: 50, // Di chuyển phần tử xuống
      opacity: 0, // Bắt đầu với opacity 0
      duration: 1.2,
      ease: "power3.out",
    });
  });

  // Slide right effect
  gsap.utils.toArray(".slide-right").forEach((el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 80%", // Bắt đầu khi phần tử vào 80% viewport
        toggleActions: "play none none none", // Chạy hiệu ứng một lần
      },
      x: -100, // Di chuyển phần tử từ bên trái (x: -100)
      opacity: 0, // Bắt đầu với opacity 0
      duration: 1.2,
      ease: "power3.out",
    });
  });

  // Slide left effect
  gsap.utils.toArray(".slide-left").forEach((el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 80%", // Bắt đầu khi phần tử vào 80% viewport
        toggleActions: "play none none none", // Chạy hiệu ứng một lần
      },
      x: 100, // Di chuyển phần tử từ bên phải (x: 100)
      opacity: 0, // Bắt đầu với opacity 0
      duration: 1.2,
      ease: "power3.out",
    });
  });
});

//thanh tab các dự án nổi bật trang chủ
document.addEventListener("DOMContentLoaded", () => {
  // Giả lập dữ liệu trả về từ API
  const apiData = {
    house: [
      {
        id: 1,
        title: "Vinhomes Ocean Park 2, ĐD6-91",
        location: "Huyện Đông Anh, Thành Phố Hà Nội",
        description:
          "ĐD6-93, Shophouse/Liền kề/Biệt thự để ở, Hoàn thiện cơ bản (có nội thất), Vinhomes Ocean Park 2",
        image: "./image/index/imageQS1.png",
        status: "Đang cho đặt cọc",
        people: 4,
        bathrooms: 3,
        area: "70,00m2",
      },
      {
        id: 2,
        title: "Vinhomes Ocean Park 2, ĐD6-92",
        location: "Huyện Đông Anh, Thành Phố Hà Nội",
        description:
          "ĐD6-92, Shophouse/Liền kề/Biệt thự để ở, Hoàn thiện cơ bản (có nội thất), Vinhomes Ocean Park 2",
        image: "./image/index/imageQS2.png",
        status: "Sắp mở bán",
        people: 5,
        bathrooms: 4,
        area: "85,00m2",
      },
      {
        id: 3,
        title: "Vinhomes Ocean Park 2, ĐD6-92",
        location: "Huyện Đông Anh, Thành Phố Hà Nội",
        description:
          "ĐD6-92, Shophouse/Liền kề/Biệt thự để ở, Hoàn thiện cơ bản (có nội thất), Vinhomes Ocean Park 2",
        image: "./image/index/imageQS2.png",
        status: "Sắp mở bán",
        people: 5,
        bathrooms: 4,
        area: "85,00m2",
      },
      {
        id: 4,
        title: "Vinhomes Ocean Park 2, ĐD6-91",
        location: "Huyện Đông Anh, Thành Phố Hà Nội",
        description:
          "ĐD6-93, Shophouse/Liền kề/Biệt thự để ở, Hoàn thiện cơ bản (có nội thất), Vinhomes Ocean Park 2",
        image: "./image/index/imageQS1.png",
        status: "Đang cho đặt cọc",
        people: 5,
        bathrooms: 4,
        area: "70,00m2",
      },
    ],
    villa: [
      {
        id: 21,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    apartment: [
      {
        id: 31,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    room: [
      {
        id: 41,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    office: [
      {
        id: 51,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    hotel: [
      {
        id: 61,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    land: [
      {
        id: 71,
        title: "Vinhomes Gardenia Villa, ĐA-01",
        location: "Quận Cầu Giấy, Thành phố Hà Nội",
        description: "Biệt thự cao cấp, hoàn thiện nội thất, đầy đủ tiện nghi.",
        image: "./image/index/imageQS3.png",
        status: "Sắp mở bán",
        people: 6,
        bathrooms: 5,
        area: "120,00m2",
      },
    ],
    // Các tab khác tương tự...
  };

  const swiperWrapper = document.getElementById("swiper-wrapper-project");

  // Hàm tạo slide cho dữ liệu
  function createSlides(data) {
    swiperWrapper.innerHTML = ""; // Xóa các slide cũ
    data.forEach((item) => {
      const slide = document.createElement("div");
      slide.classList.add("swiper-slide");

      // Thêm nội dung vào slide
      slide.innerHTML = `
        <a href="detailProject.html">
          <div class="relative overflow-hidden rounded-lg">
            <img
              alt="${item.title}"
              class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="${item.image}"
            />
           <div
              class="absolute px-4 py-2 text-sm text-white rounded-xl bottom-4 right-4"
              style="background: ${
                item.status === "Sắp mở bán"
                  ? "#e04444"
                  : "linear-gradient(90deg, #182c77 0%, #6274bb 100%)"
              };"

            >
              ${item.status}
            </div>
          </div>
          <h2 class="mt-4 text-xl font-bold">${item.title}</h2>
          <div class="flex items-center mt-2">
            <img src="./image/icons/iconLocation.png" alt="icon" class="h-6 mr-2" />
            ${item.location}
          </div>
          <p class="mt-2 text-gray-400 description">${item.description}</p>
          <div class="flex items-center mt-4 text-gray-400">
            <img src="./image/icons/iconBed.png" alt="icon" width="24" class="mr-2" />
            ${item.people} người
            <div class="w-[0.5px] h-6 bg-white mx-4"></div>
            <img src="./image/icons/iconBath.png" alt="icon" width="24" class="mr-2" />
            ${item.bathrooms} tắm
            <div class="w-[0.5px] h-6 bg-white mx-4"></div>
            <img src="./image/icons/iconExpand.png" alt="icon" width="24" class="mr-2" />
            ${item.area}
          </div>
        </a>
      `;

      // Thêm slide vào swiper-wrapper
      swiperWrapper.appendChild(slide);
    });
  }

  // Hàm khởi tạo lại Swiper
  function initSwiper() {
    return new Swiper(".mySwiper-Projects", {
      slidesPerView: 1, // Mặc định cho màn hình nhỏ
      spaceBetween: 30,
      loop: true, // Bật loop
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2, // 2 slides cho các thiết bị từ 640px
        },
        1024: {
          slidesPerView: 3, // 3 slides cho các thiết bị từ 1024px
        },
      },
    });
  }

  let swiper = initSwiper(); // Khởi tạo Swiper lần đầu

  // Lắng nghe sự kiện click trên các tab
  document.querySelectorAll(".heroSection-project-select a").forEach((tab) => {
    tab.addEventListener("click", function (e) {
      e.preventDefault();

      // Gỡ bỏ class "active" từ tất cả các tab
      document
        .querySelectorAll(".heroSection-project-select a")
        .forEach((t) => t.classList.remove("active"));

      // Thêm class "active" cho tab đã nhấn
      this.classList.add("active");

      // Lấy tên tab đã chọn
      const tabId = this.getAttribute("data-tab");

      // Tạo các slide cho tab đã chọn
      createSlides(apiData[tabId]);

      // Hủy Swiper cũ và khởi tạo lại Swiper mới
      swiper.destroy(true, true); // Hủy Swiper cũ
      swiper = initSwiper(); // Khởi tạo lại Swiper mới
    });
  });

  // Tải dữ liệu ban đầu cho tab "Nhà ở"
  createSlides(apiData.house);
});

//thanh tab tin tuc o trna chu
document.addEventListener("DOMContentLoaded", () => {
  // Dữ liệu giả cho từng tab
  const fakeData = {
    all: [
      {
        id: 1,
      },
    ],
    project: [
      {
        id: 2,
      },
    ],
    "market-analysis": [
      {
        id: 3,
      },
    ],
    "financial-solutions": [
      {
        id: 2,
      },
    ],
    "real-estate": [
      {
        id: 2,
      },
    ],
    // Các tab khác
  };

  // Lắng nghe sự kiện click trên các tab
  document.querySelectorAll(".tab").forEach((tab) => {
    tab.addEventListener("click", function (e) {
      e.preventDefault();

      // Xóa lớp active khỏi tất cả các tab và tab content
      document
        .querySelectorAll(".tab")
        .forEach((t) => t.classList.remove("active"));
      document
        .querySelectorAll(".tab-pane")
        .forEach((pane) => pane.classList.add("hidden")); // ẩn tất cả các tab

      // Thêm lớp active vào tab được nhấn
      tab.classList.add("active");

      // Lấy id của nội dung tab và hiển thị nó
      const tabContentId = tab.getAttribute("data-tab");
      const tabContent = document.getElementById(tabContentId);
      tabContent.classList.remove("hidden"); // Hiển thị nội dung của tab

      // Cập nhật nội dung của tab
      updateTabContent(tabContentId);
    });
  });

  // Cập nhật nội dung cho tab
  function updateTabContent(tabId) {
    const contentContainer = document.getElementById(`tab-${tabId}-content`);
    contentContainer.innerHTML = ""; // Xóa nội dung cũ

    const data = fakeData[tabId];
    data.forEach((item) => {
      const contentHTML = `
      
      <div class="flex-col hidden lg:flex lg:flex-row">
          <a href="#" class="mr-6 overflow-hidden">
            <div class="overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-96 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>
              <p class="mb-4 text-gray-600">
                A spacious and modern home with an open floor plan, large
                windows, and a beautifully landscaped garden. Perfect for those
                seeking peace and tranquility.
              </p>
              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <div class="flex flex-col space-y-4">
            <a href="#" class="flex overflow-hidden">
              <div class="w-full overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="flex overflow-hidden">
              <div class="w-full overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="flex overflow-hidden">
               <div class="w-full overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div
          class="grid grid-cols-1 space-y-4 sm:grid-cols-2 lg:hidden sm:space-y-0"
        >
          <a href="#" class="mr-6 overflow-hidden">
             <div class="w-full overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>

              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="mr-6 overflow-hidden">
             <div class="w-full overflow-hidden rounded-lg">
              <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44 transition-all duration-300 ease-in-out transform hover:scale-105"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
             />
            </div>
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>

              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
        </div>
    `;
      contentContainer.innerHTML += contentHTML;
    });
  }

  // Khởi tạo nội dung cho tab đầu tiên khi trang load
  updateTabContent("all");
});

//thanh tab trang tin tuc
document.addEventListener("DOMContentLoaded", () => {
  // Fake data for each tab
  const tabData = {
    "all-posts": [""],
    projects: [""],
    "market-analysis": [],
    "financial-solutions": [],
    "real-estate": [],
    // Add similar objects for other tabs (market-analysis, financial-solutions, real-estate)
  };

  // Generate content for each tab
  function generateTabContent(tabId) {
    const contentArea = document.getElementById(tabId);
    const articles = tabData[tabId];

    contentArea.innerHTML = ""; // Clear existing content

    if (articles && articles.length > 0) {
      articles.forEach((article) => {
        const articleHTML = `
           <a href="detailProject.html" class="rounded-lg">
          <div class="relative overflow-hidden rounded-lg">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover w-full h-[340px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="./image/news/bgNews.png"
            />
            <div
              class="absolute text-sm text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Đang mở bánQ1/2024: Sắp bán khu căn hộ
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div
            class="flex flex-col justify-between sm:items-center sm:flex-row"
          >
            <div class="flex items-center mt-2 text-[#142A72] font-bold">
              <img
                src="./image/icons/iconLocationBlack.png"
                alt="icon"
                class="h-6 mr-2"
              />
              Huyện Đông Anh, Thành Phố Hà Nội
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="text-[#142A72]">385 ha</p>
            </div>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
          </p>
        </a>

         <div class="flex flex-col mt-4 space-y-4">
          <a href="#" class="flex flex-col overflow-hidden md:flex-row">
            <div class="relative overflow-hidden rounded-lg w-auto md:w-[64%] h-44">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="./image/news/bgNews.png"
            />
            </div>
            <div class="pl-0 md:pl-4 w-auto md:w-[90%] mt-2 md:mt-0">
              <h3 class="mb-2 text-lg font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực...
              </h3>
              <p class="mt-2 text-gray-400 description">
                Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi
                động và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết
                nối, phong cách sống toàn cầu, Vinhomes Global Gate là một Thành
                phố Thương mại Quốc tế sôi động và đẳng cấp Thế giới
              </p>
              <div class="flex items-center mt-2">
                <img
                  alt="Author's profile picture"
                  class="w-8 h-8 mr-2 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="flex flex-col overflow-hidden md:flex-row">
            <div class="relative overflow-hidden rounded-lg w-auto md:w-[64%] h-44">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="./image/news/bgNews.png"
            />
            </div>
            <div class="pl-0 md:pl-4 w-auto md:w-[90%] mt-2 md:mt-0">
              <h3 class="mb-2 text-lg font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực...
              </h3>
              <p class="mt-2 text-gray-400 description">
                Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi
                động và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết
                nối, phong cách sống toàn cầu, Vinhomes Global Gate là một Thành
                phố Thương mại Quốc tế sôi động và đẳng cấp Thế giới
              </p>
              <div class="flex items-center mt-2">
                <img
                  alt="Author's profile picture"
                  class="w-8 h-8 mr-2 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="flex flex-col overflow-hidden md:flex-row">
             <div class="relative overflow-hidden rounded-lg w-auto md:w-[64%] h-44">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="./image/news/bgNews.png"
            />
            </div>
            <div class="pl-0 md:pl-4 w-auto md:w-[90%] mt-2 md:mt-0">
              <h3 class="mb-2 text-lg font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực...
              </h3>
              <p class="mt-2 text-gray-400 description">
                Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi
                động và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết
                nối, phong cách sống toàn cầu, Vinhomes Global Gate là một Thành
                phố Thương mại Quốc tế sôi động và đẳng cấp Thế giới
              </p>
              <div class="flex items-center mt-2">
                <img
                  alt="Author's profile picture"
                  class="w-8 h-8 mr-2 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
        </div>
        `;
        contentArea.insertAdjacentHTML("beforeend", articleHTML);
      });
    } else {
      contentArea.innerHTML = `<p class="text-gray-500">Không có tin tức</p>`;
    }
  }

  // Handle tab clicks
  document.querySelectorAll(".tab-link").forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();

      // Remove active class from all tabs and contents
      document
        .querySelectorAll(".tab-link")
        .forEach((link) => link.classList.remove("active"));
      document
        .querySelectorAll(".tab-content-news")
        .forEach((content) => content.classList.remove("active"));

      // Add active class to the clicked tab and its corresponding content
      const tabId = tab.getAttribute("data-tab");
      tab.classList.add("active");
      const tabContent = document.getElementById(tabId);
      tabContent.classList.add("active");

      // Generate fake content for the selected tab
      generateTabContent(tabId);
    });
  });

  // Load default tab content (all-posts)
  generateTabContent("all-posts");
});

//thanh tab các dự án liên quan trang chi tiết dự án
document.addEventListener("DOMContentLoaded", () => {
  // Giả lập dữ liệu trả về từ API
  const apiData = {
    house: [
      {
        id: 1,
        active: true,
        status: "Đang mở bánQ1/2024: Sắp bán khu căn hộ",
      },
      {
        id: 2,
        active: false,
        status: "Sắp mở bán",
      },
      {
        id: 3,
        active: true,
        status: "Đang mở bánQ1/2024: Sắp bán khu căn hộ",
      },
      {
        id: 4,
        active: true,
        status: "Đang mở bánQ1/2024: Sắp bán khu căn hộ",
      },
    ],
    villa: [
      {
        id: 5,
      },
    ],
    apartment: [],
    "market-analysis": [],
    "financial-solutions": [],
    "real-estate": [],
    // Các tab khác tương tự...
  };

  const swiperWrapper = document.getElementById("swiper-wrapper");

  // Hàm tạo slide cho dữ liệu
  function createSlides(data) {
    swiperWrapper.innerHTML = ""; // Xóa các slide cũ
    data.forEach((item) => {
      const slide = document.createElement("div");
      slide.classList.add("swiper-slide");

      // Thêm nội dung vào slide
      slide.innerHTML = `
        <a href="detailProject.html">
          <div class="relative">
              <img
                alt="Modern house with large windows and landscaped garden"
                class="object-cover w-full h-[440px] rounded-lg"
                src="./image/index/imageQS1.png"
              />
              <div
                class="absolute text-white  py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
                style="background: ${
                  item.active === false
                    ? "#e04444"
                    : "linear-gradient(90deg, #182c77 0%, #6274bb 100%)"
                };"
              >
               ${item.status}
              </div>
            </div>
          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]">385 ha</p>
            </div>
            <p class="mt-2 text-gray-400 description">
              Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động
              và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối,
              phong cách sống toàn cầu
            </p>
        </a>
      `;

      // Thêm slide vào swiper-wrapper
      swiperWrapper.appendChild(slide);
    });
  }

  // Hàm khởi tạo lại Swiper
  function initSwiper() {
    return new Swiper(".mySwiper-Projects", {
      slidesPerView: 1, // Mặc định cho màn hình nhỏ
      spaceBetween: 30,
      loop: true, // Bật loop
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2, // 2 slides cho các thiết bị từ 640px
        },
        1024: {
          slidesPerView: 3, // 3 slides cho các thiết bị từ 1024px
        },
      },
    });
  }

  let swiper = initSwiper(); // Khởi tạo Swiper lần đầu

  // Lắng nghe sự kiện click trên các tab
  document.querySelectorAll(".heroSection-news-select a").forEach((tab) => {
    tab.addEventListener("click", function (e) {
      e.preventDefault();

      // Gỡ bỏ class "active" từ tất cả các tab
      document
        .querySelectorAll(".heroSection-news-select a")
        .forEach((t) => t.classList.remove("active"));

      // Thêm class "active" cho tab đã nhấn
      this.classList.add("active");

      // Lấy tên tab đã chọn
      const tabId = this.getAttribute("data-tab");

      // Tạo các slide cho tab đã chọn
      createSlides(apiData[tabId]);

      // Hủy Swiper cũ và khởi tạo lại Swiper mới
      swiper.destroy(true, true); // Hủy Swiper cũ
      swiper = initSwiper(); // Khởi tạo lại Swiper mới
    });
  });

  // Tải dữ liệu ban đầu cho tab "Nhà ở"
  createSlides(apiData.house);
});

//thanh tab các tiện ích trogn màn chi tiết dự án
document.addEventListener("DOMContentLoaded", () => {
  const fakeData = {
    school: [
      {
        title: "Vinschool Grand Park",
        desc: "Vinschool Grand Park là hệ thống trường liên cấp tại khu đô thị Vinhomes Grand Park. Đây là địa chỉ giáo dục có quy mô và chất lượng hàng đầu.",
        img: "./image/project/imgProjectSchool.png",
      },
      {
        title: "Trường Quốc tế Brighton College",
        desc: "Brighton College Vietnam (BCVN) tại Hà Nội là cơ sở đầu tiên thuộc dự án hợp tác giữa Tập đoàn Vingroup và Brighton College – ngôi trường danh giá của Vương Quốc Anh.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
    entertainment: [
      {
        title: "Rạp chiếu phim CGV",
        desc: "Trải nghiệm xem phim đỉnh cao với hệ thống rạp chiếu phim hiện đại và không gian sang trọng.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
    shopping: [
      {
        title: "Vincom Mega Mall",
        desc: "Khu mua sắm sầm uất với hàng trăm thương hiệu nổi tiếng trong và ngoài nước.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
    restaurant: [
      {
        title: "Nhà hàng Red Sun",
        desc: "Thưởng thức ẩm thực Á Âu với phong cách phục vụ đẳng cấp tại nhà hàng Red Sun.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
    park: [
      {
        title: "Công viên Vinhomes Central Park",
        desc: "Không gian xanh rộng lớn với nhiều tiện ích thể thao và vui chơi giải trí.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
    hospital: [
      {
        title: "Bệnh viện Đa khoa Quốc tế Vinmec",
        desc: "Hệ thống chăm sóc sức khỏe tiêu chuẩn quốc tế với đội ngũ bác sĩ chuyên môn cao.",
        img: "./image/project/imgProjectSchool.png",
      },
    ],
  };

  // Render nội dung theo tab
  function renderTabContent(tab) {
    const container = document.getElementById("tab-content");
    const data = fakeData[tab] || [];
    container.innerHTML = data
      .map(
        (item) => `
        <div class="flex items-start mb-6">
          <img
            alt="${item.title} image"
            class="object-cover h-24 mr-4 rounded-lg w-36"
            src="${item.img}"
          />
          <div>
            <h2 class="text-lg font-bold text-blue-900">${item.title}</h2>
            <p class="text-sm text-gray-600">${item.desc}</p>
          </div>
        </div>
      `
      )
      .join("");
  }

  // Sự kiện click cho các tab
  document.querySelectorAll(".tab-link").forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();

      // Thêm class 'active' cho tab được chọn
      document
        .querySelectorAll(".tab-link")
        .forEach((t) => t.classList.remove("text-blue-700", "active"));
      tab.classList.add("text-blue-700", "active");

      // Render nội dung tương ứng
      const selectedTab = tab.getAttribute("data-tab");
      renderTabContent(selectedTab);
    });
  });

  // Render nội dung mặc định
  renderTabContent("school");
});
