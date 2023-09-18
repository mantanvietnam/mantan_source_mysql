$(document).ready(function() {
   
 // topbar
 $(".language-box").hide();
 $(".change-language span").click(function(){
   $(".language-box").toggle();
 });

// Lấy đối tượng "section 2"
var section2 = document.getElementById('section-keydate');

// Lắng nghe sự kiện scroll trên cửa sổ
window.addEventListener('scroll', function() {
  // Lấy vị trí của "section 2" trong tài liệu
  var section2Rect = section2.getBoundingClientRect();

  // Kiểm tra xem "section 2" có trong tầm nhìn (viewport) không
  if (section2Rect.top <= window.innerHeight && section2Rect.bottom >= 0) {
    // Nếu "section 2" hiển thị trong tầm nhìn, chạy hàm sau khi cuộn đến "section 2"
    runFunctionAfterScrollToSection2();
  }
});

// Hàm để chạy sau khi cuộn đến "section 2"
function runFunctionAfterScrollToSection2() {
    console.log('a');
  
   // dem so
   const classOdometer = document.querySelector('.odometer')
   const odometer = new Odometer({
     el:classOdometer,
     duration: 5000
   })
   classOdometer.innerHTML = 20;

   const classOdometer2 = document.querySelector('.odometer2')
   const odometer2 = new Odometer({
     el:classOdometer2,
     duration: 5000
   })
   classOdometer2.innerHTML = 200;

   const classOdometer3 = document.querySelector('.odometer3')
   const odometer3 = new Odometer({
     el:classOdometer3,
     duration: 5000
   })

   classOdometer3.innerHTML = 9;

   const classOdometer4 = document.querySelector('.odometer4')
   const odometer4 = new Odometer({
     el:classOdometer4,
     duration: 5000
   })

   classOdometer4.innerHTML = 10;
}
});




  