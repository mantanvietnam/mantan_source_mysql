document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const sidebarToggleClose = document.getElementById("sidebarToggleClose");
    const sidebarToggleOpen = document.getElementById("sidebarToggleOpen");
    const mobileMenuToggle = document.getElementById("mobileMenuToggle");

    // Toggle sidebar khi click nút trong sidebar
    sidebarToggleClose.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("expanded");

        sidebarToggleOpen.classList.remove("d-none");

        // Đổi icon khi toggle
        // const icon = sidebarToggle.querySelector("i");
        // if (sidebar.classList.contains("collapsed")) {
        //     icon.classList.remove("fa-chevron-left");
        //     icon.classList.add("fa-chevron-right");
        // } else {
        //     icon.classList.remove("fa-chevron-right");
        //     icon.classList.add("fa-chevron-left");
        // }
    });

    // sidebarToggleOpen.addEventListener("click", function () {
    //     sidebar.classList.toggle("collapsed");
    //     content.classList.toggle("expanded");

    //     sidebarToggleOpen.classList.add("d-none");
    // });

    // Toggle sidebar khi click nút mobile
    mobileMenuToggle.addEventListener("click", function () {
        sidebar.classList.toggle("expanded");

        // Thêm overlay khi sidebar mở trên mobile
        if (sidebar.classList.contains("expanded")) {
            const overlay = document.createElement("div");
            overlay.id = "sidebarOverlay";
            overlay.style.position = "fixed";
            overlay.style.top = "0";
            overlay.style.left = "0";
            overlay.style.width = "100%";
            overlay.style.height = "100%";
            overlay.style.backgroundColor = "rgba(0,0,0,0.5)";
            overlay.style.zIndex = "998";
            document.body.appendChild(overlay);

            overlay.addEventListener("click", function () {
                sidebar.classList.remove("expanded");
                document.body.removeChild(overlay);
            });
        } else {
            const overlay = document.getElementById("sidebarOverlay");
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }
    });
    // Thiết lập mặc định cho mobile
    if (window.innerWidth < 768) {
        sidebar.classList.remove("expanded");
        sidebar.classList.add("collapsed");
        content.classList.add("expanded");
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const userInfoContainer = document.getElementById("userInfoContainer");
    const userDropdown = document.getElementById("userDropdown");

    userInfoContainer.addEventListener("click", function (event) {
        userDropdown.classList.toggle("active");
        event.stopPropagation();
    });

    document.addEventListener("click", function (event) {
        if (!userInfoContainer.contains(event.target)) {
            userDropdown.classList.remove("active");
        }
    });
});

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

document.getElementById("fileUpload").addEventListener("change", function (event) {
    const file = event.target.files[0]; // Lấy file ảnh
  
    if (file) {
      const reader = new FileReader();
  
      reader.onload = function (e) {
        const previewImage = document.getElementById("previewImage");
        const uploadBox = document.getElementById("uploadBox");
  
        previewImage.src = e.target.result;
        previewImage.classList.remove("hidden"); // Hiển thị ảnh xem trước
  
        document.getElementById("uploadText").textContent = "Ảnh đã tải lên";
        uploadBox.style.border = "2px solid rgba(252, 70, 167, 1)"; // Đổi màu viền
      };
  
      reader.readAsDataURL(file);
    } else {
      alert("Vui lòng chọn một ảnh hợp lệ!");
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const colorOptions = document.querySelectorAll(".color-option");
    const selectedColorInput = document.getElementById("selectedColor");
  
    colorOptions.forEach((colorOption) => {
      // Gán màu nền cho mỗi ô màu
      colorOption.style.backgroundColor = colorOption.getAttribute("data-color");
  
      colorOption.addEventListener("click", function () {
        // Xóa class 'active' khỏi tất cả các ô
        colorOptions.forEach((c) => c.classList.remove("active"));
  
        // Thêm class 'active' vào ô được chọn
        this.classList.add("active");
  
        // Cập nhật giá trị màu đã chọn
        selectedColorInput.value = this.getAttribute("data-color");
        console.log("Màu tóc đã chọn:", selectedColorInput.value);
      });
    });
  });
  
// JavaScript để xử lý đóng/mở sidebar
document.getElementById('sidebarToggleClose').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('content').classList.toggle('expanded');
});