var contentMain = document.querySelector('.describe-description-filter');
contentMain.classList.add('hideContent');

document.querySelectorAll(".describe-more button").forEach(function(link) {
    link.addEventListener("click", function() {
      var content = this.parentElement.previousElementSibling;
      var linkText = this.textContent.toUpperCase();
  
      if (linkText === "XEM THÊM") {
        linkText = "Rút gọn";
        content.classList.remove("hideContent");
        content.classList.add("showContent");
      } else {
        linkText = "Xem thêm";
        content.classList.remove("showContent");
        content.classList.add("hideContent");
      }
  
      this.textContent = linkText;
    });
  });   