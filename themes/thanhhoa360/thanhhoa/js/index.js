document.querySelector('.header-btn-1').addEventListener('click', function() {
    // Lấy thẻ .header-container để toggle class no-overlay
    const headerContainer = document.querySelector('.header-container');
    headerContainer.classList.toggle('no-overlay');
  
    const stopWatchBtn = document.querySelector('.btn-stop-watch');
    stopWatchBtn.style.display = 'flex'; // Hiển thị nút
    
    // Lấy thẻ .header-back-container và ẩn nó
    const headerBackContainer = document.querySelector('.header-back-container');
    headerBackContainer.classList.add('hidden'); // Thêm class hidden để ẩn thẻ
  });
  
  document.querySelector('.btn-stop-watch').addEventListener('click', function() {
    const headerContainer = document.querySelector('.header-container');
    headerContainer.classList.toggle('no-overlay');
    // Ẩn nút .btn-stop-watch
    const stopWatchBtn = document.querySelector('.btn-stop-watch');
    stopWatchBtn.style.display = 'none'; // Hoặc sử dụng class hidden nếu bạn muốn ẩn với class
  
    // Hiện lại thẻ .header-back-container
    const headerBackContainer = document.querySelector('.header-back-container');
    headerBackContainer.classList.remove('hidden'); // Loại bỏ class hidden để hiện lại thẻ
  });
  
  
  // Hàm để xử lý khi phần tử xuất hiện trên màn hình
  const options = {
    root: null, // Sử dụng viewport làm root
    rootMargin: '0px', // Khoảng cách bổ sung từ các cạnh của root (viewport)
    threshold: 0.5, // Phần trăm của phần tử cần phải hiển thị trên màn hình mới kích hoạt
  };
  
  // Tạo một observer để theo dõi các phần tử
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Nếu phần tử xuất hiện trên màn hình, thêm class 'visible'
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // Ngừng theo dõi phần tử này sau khi đã hiển thị
      }
    });
  }, options);
  
  // Chọn tất cả các phần tử cần theo dõi
  const locationContainers = document.querySelectorAll('.location-container');
  
  // Bắt đầu theo dõi các phần tử
  locationContainers.forEach(container => {
    observer.observe(container);
  });
  
  // mappppppppppppppppppppp
  
  // Khởi tạo bản đồ với tâm ở Thanh Hóa
  const map = L.map('map').setView([19.806692, 105.776869], 10);
  
  // Thêm lớp bản đồ từ OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
  }).addTo(map);
  
  // Dữ liệu địa điểm
  const locations = [
    { lat: 19.8148, lng: 105.7684, type: 'culture', name: 'Di tích Lam Kinh' },
    { lat: 19.9278, lng: 105.8876, type: 'scenic', name: 'Pù Luông' },
    { lat: 19.8708, lng: 105.7344, type: 'community', name: 'Làng cổ Đông Sơn' },
  ];
  
  // Tùy chỉnh icon
  const icons = {
    culture: L.icon({ iconUrl: './assets/images/location.png', iconSize: [30, 30] }),
    scenic: L.icon({ iconUrl: './assets/images/location.png', iconSize: [30, 30] }),
    community: L.icon({ iconUrl: './assets/images/location.png', iconSize: [30, 30] }),
  };
  
  // Tạo đối tượng markers theo loại
  // Tạo đối tượng markers và locationNames theo loại
  const markers = {
    culture: [],
    scenic: [],
    community: [],
  };
  
  const locationNames = {
    culture: [],
    scenic: [],
    community: [],
  };
  
  // Thêm marker và tên địa điểm lên bản đồ
  locations.forEach((location) => {
    // Tạo marker với biểu tượng tùy chỉnh
    const marker = L.marker([location.lat, location.lng], { icon: icons[location.type] })
      .bindPopup(`<b>${location.name}</b>`);
    markers[location.type].push(marker);
  
    // Tạo tên địa điểm bằng DivIcon
    const nameIcon = L.divIcon({
      className: 'location-name',
      html: `<span>${location.name}</span>`,
      iconSize: [0, 0],
    });
  
    const nameMarker = L.marker([location.lat, location.lng], { icon: nameIcon });
    locationNames[location.type].push(nameMarker);
  
    // Thêm marker và tên địa điểm ban đầu vào bản đồ
    marker.addTo(map);
    nameMarker.addTo(map);
  });
  
  // Xử lý sự kiện thay đổi checkbox
  document.querySelectorAll('.filter-options input').forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
      const checkedFilters = Array.from(
        document.querySelectorAll('.filter-options input:checked')
      ).map((cb) => cb.id);
  
      // Nếu "Tất cả địa điểm" được chọn
      if (checkedFilters.includes('all')) {
        // Hiển thị tất cả các marker và tên địa điểm
        Object.values(markers).flat().forEach((marker) => marker.addTo(map));
        Object.values(locationNames).flat().forEach((nameMarker) => nameMarker.addTo(map));
      } else {
        // Ẩn tất cả các marker và tên địa điểm
        Object.values(markers).flat().forEach((marker) => map.removeLayer(marker));
        Object.values(locationNames).flat().forEach((nameMarker) => map.removeLayer(nameMarker));
  
        // Hiển thị các marker và tên địa điểm theo loại được chọn
        checkedFilters.forEach((filter) => {
          if (markers[filter]) {
            markers[filter].forEach((marker) => marker.addTo(map));
          }
          if (locationNames[filter]) {
            locationNames[filter].forEach((nameMarker) => nameMarker.addTo(map));
          }
        });
        // Bỏ chọn "Tất cả địa điểm" nếu có loại khác được chọn
      }
    });
  });
  
  //slider-------------------------------------------
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });
  
  // Danh sách nội dung sự kiện cho từng tháng----------------------------------------
  const eventsData = {
    8: {
      title: "Khai trương mùa lễ hội mùa hè",
      description: "Mùa lễ hội mùa hè bắt đầu với nhiều hoạt động hấp dẫn tại các địa điểm nổi tiếng.",
      location: "Hà Nội",
      date: "15/08/2023",
      phone: "0988 123 456",
      image: "./assets/images/bestnew.png",
    },
    9: {
      title: "Khánh thành tượng đài con tàu tập kết ra Bắc",
      description:
        "Tượng đài con tàu tập kết ra Bắc được khánh thành, đánh dấu một sự kiện lịch sử trọng đại.",
      location: "Lào Cai",
      date: "11/07/2023",
      phone: "0868 373 777",
      image: "./assets/images/bestnew.png",
    },
    10: {
      title: "Lễ hội đón mùa thu",
      description:
        "Lễ hội mùa thu với không gian văn hóa độc đáo và nhiều hoạt động nghệ thuật thú vị.",
      location: "Hội An",
      date: "05/10/2023",
      phone: "0933 456 789",
      image: "./assets/images/bestnew.png",
    },
  };
  
  let currentMonth = 9; // Tháng hiện tại
  
  // Cập nhật nội dung sự kiện dựa trên tháng
  function updateEvent(month) {
    const event = eventsData[month];
    if (!event) return;
  
    document.getElementById("current-month").textContent = `Tháng ${month}`;
    document.getElementById("event-title").textContent = event.title;
    document.getElementById("event-description").textContent = event.description;
    document.getElementById("event-location").textContent = event.location;
    document.getElementById("event-date").textContent = event.date;
    document.getElementById("event-phone").textContent = event.phone;
    document.getElementById("best-new-img").src = event.image;
  }
  
  // Xử lý khi nhấn nút Back
  document.getElementById("btn-back").addEventListener("click", () => {
    currentMonth = currentMonth === 8 ? 10 : currentMonth - 1; // Vòng lặp tháng 8-10
    updateEvent(currentMonth);
  });
  
  // Xử lý khi nhấn nút Next
  document.getElementById("btn-next").addEventListener("click", () => {
    currentMonth = currentMonth === 10 ? 8 : currentMonth + 1; // Vòng lặp tháng 8-10
    updateEvent(currentMonth);
  });
  
  // Hiển thị sự kiện tháng hiện tại
  updateEvent(currentMonth);
  
  