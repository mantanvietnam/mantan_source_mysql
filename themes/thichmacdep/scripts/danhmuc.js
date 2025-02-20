document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll('.category-nav-item');

  navItems.forEach(item => {
    item.addEventListener('click', function () {
      // Loại bỏ class 'active' khỏi tất cả các item
      navItems.forEach(nav => nav.classList.remove('active'));
      
      // Thêm class 'active' vào item được click
      this.classList.add('active');
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const pageNumbers = document.querySelectorAll('.page-number');

  pageNumbers.forEach(page => {
    page.addEventListener('click', function () {
      // Xóa lớp active khỏi tất cả các phần tử
      pageNumbers.forEach(p => p.classList.remove('active'));

      // Thêm lớp active cho phần tử được click
      this.classList.add('active');
    });
  });
});

