const mainHead = document.querySelector( '.main-head' );
const showcase = document.querySelector( '.showcase' );
const toggler = document.querySelector( '.toggler' );
toggler.addEventListener( 'click', function(){
    mainHead.classList.toggle( 'active' );
    showcase.classList.toggle( 'width' );
} )

function toggleSearchForm() {
    const searchForm = document.getElementById("formSearchDate");
    if (searchForm.style.display === "none") {
        searchForm.style.display = "block";
    } else {
        searchForm.style.display = "none";
    }
}

// Đóng form nếu nhấp bên ngoài
document.addEventListener("click", function (event) {
    const filter = document.querySelector(".filter");
    const searchForm = document.getElementById("formSearchDate");

    if (!filter.contains(event.target)) {
        searchForm.style.display = "none";
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    // Xử lý sự kiện submit form
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const searchQuery = searchInput.value.trim();
        if (searchQuery) {
            console.log('Đang tìm kiếm:', searchQuery);
            // Thêm logic tìm kiếm của bạn ở đây
        }
    });

    // Xử lý phím tắt '/'
    document.addEventListener('keydown', function(e) {
        if (e.key === '/' && document.activeElement !== searchInput) {
            e.preventDefault();
            searchInput.focus();
        }
    });

    // Tùy chọn: thêm sự kiện để xử lý khi người dùng gõ
    searchInput.addEventListener('input', function(e) {
        const searchQuery = e.target.value.trim();
        if (searchQuery) {
            console.log('Đang gõ:', searchQuery);
            // Thêm logic gợi ý tìm kiếm (nếu cần)
        }
    });
});
const fileInput = document.getElementById("file-input");
const imagePreview = document.getElementById("img-preview");
const toast = document.getElementById("toast");

fileInput.addEventListener("change", (e) => {
  if (e.target.files.length) {
    const src = URL.createObjectURL(e.target.files[0]);
    imagePreview.src = src;
    showToast();
  }
});

function showToast() {
  toast.classList.add("show");
  setTimeout(() => toast.classList.remove("show"), 3000);
}
