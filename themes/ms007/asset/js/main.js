// xử lý active menu
$(document).ready(function(){
    $('.navbar-nav .nav-item .nav-link').click(function(){
      $('.navbar-nav .nav-item .nav-link').removeClass('active');
      $(this).addClass('active');
    });
  });

  var scrollPage = document.getElementById("menu-top");

  window.onscroll = function() {
      if (window.pageYOffset > 120 || document.documentElement.scrollTop > 120) {
          scrollPage.style.position = "fixed";
          scrollPage.style.backgroundColor = "#00163D";
          scrollPage.style.left = "0";
          scrollPage.style.right = "0";
          scrollPage.style.zIndex  = "100";
          scrollPage.style.boxShadow = "0 10px 15px rgba(25,25,25,0.1)";
          scrollPage.classList.add("scroll-header")
          
      } else {
          scrollPage.style.position = "relative";
          scrollPage.style.left = "0";
          scrollPage.style.right = "0";
          scrollPage.style.boxShadow = "none";
          scrollPage.classList.remove("scroll-header")
        scrollPage.style.boxShadow = "0 10px 15px rgba(25,25,25,0.1)";
  
  
      }
  }