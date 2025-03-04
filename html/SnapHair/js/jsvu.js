document.addEventListener("DOMContentLoaded", function () {
    // Get all necessary elements
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");
    const sidebarImg = document.querySelector(".sidebar-img");
    const mainContent = document.querySelector(".main-content");
    const menuContainer = document.querySelector(".menu-container");

    toggleBtn.addEventListener("click", function () {
        // Toggle sidebar expanded state
        sidebar.classList.toggle("expanded");
        menuContainer.classList.toggle("expanded");

        // Update main content margin
        if (sidebar.classList.contains("expanded")) {
            // When sidebar is expanded
            sidebarImg.src = sidebarImg.getAttribute("data-expanded");
            mainContent.style.marginLeft = "267px"; // 247px + 20px left margin
            toggleBtn.querySelector("i").classList.remove("fa-circle-right");
            toggleBtn.querySelector("i").classList.add("fa-circle-left");
        } else {
            // When sidebar is collapsed
            sidebarImg.src = sidebarImg.getAttribute("data-default");
            mainContent.style.marginLeft = "68px"; // 48px + 20px left margin
            toggleBtn.querySelector("i").classList.remove("fa-circle-left");
            toggleBtn.querySelector("i").classList.add("fa-circle-right");
        }
    });

    // Handle window resize
    window.addEventListener("resize", function() {
        // You can add additional responsive behavior here if needed
        if (window.innerWidth < 768) {
            // For mobile devices
            mainContent.style.marginLeft = sidebar.classList.contains("expanded") ? "267px" : "68px";
        }
    });

    // Initialize proper state on page load
    if (sidebar.classList.contains("expanded")) {
        mainContent.style.marginLeft = "267px";
        toggleBtn.querySelector("i").classList.add("fa-circle-left");
    } else {
        mainContent.style.marginLeft = "68px";
        toggleBtn.querySelector("i").classList.add("fa-circle-right");
    }
});
function selectFace(element, name) {
    // Xóa lớp active khỏi tất cả ảnh
    document.querySelectorAll('.face-list img').forEach(img => img.classList.remove('active'));
    
    // Thêm lớp active cho ảnh được chọn
    element.classList.add('active');
    
    // Thay đổi ảnh hiển thị bên phải
    document.getElementById('selectedFace').src = element.src;
    
    // Cập nhật tên mẫu
    document.getElementById('faceName').textContent = name;
}

// Xử lý khi click vào vùng upload
document.querySelector('.border-dashed').addEventListener('click', function() {
    // Tạo input type file ẩn
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.multiple = true;
    
    // Kích hoạt click cho input
    input.click();
    
    // Xử lý khi chọn file
    input.onchange = function() {
        const files = Array.from(this.files);
        // Xử lý files ở đây
        files.forEach(file => {
            console.log('File được chọn:', file.name);
            // Thêm code xử lý file của bạn ở đây
        });
    };
});

// Xử lý khi kéo thả file
const dropZone = document.querySelector('.border-dashed');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.style.backgroundColor = 'rgba(0,0,0,0.05)';
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.style.backgroundColor = '';
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.style.backgroundColor = '';
    
    const files = Array.from(e.dataTransfer.files);
    files.forEach(file => {
        if (file.type.startsWith('image/')) {
            console.log('File được thả:', file.name);
            // Thêm code xử lý file của bạn ở đây
        }
    });
});

$(document).ready(function() {
    $('#image-input').change(function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#generate-image').click(function() {
        alert('Tính năng tạo ảnh đang được phát triển!');
    });

    $('#download').click(function() {
        alert('Tải xuống hình ảnh!');
    });

    $('#favorite').click(function() {
        alert('Đã thêm vào danh sách yêu thích!');
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");

    // Kiểm tra nếu phần tử tồn tại trước khi thêm sự kiện
    if (menuToggle && sidebar) {
      menuToggle.addEventListener("click", function () {
        sidebar.classList.toggle("open");
      });
    } else {
      console.error("Không tìm thấy menu-toggle hoặc sidebar");
    }
  });