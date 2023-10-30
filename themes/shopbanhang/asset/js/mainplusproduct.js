document.querySelectorAll(".describe-more button").forEach(function(link) {
    link.addEventListener("click", function() {
      var content = this.parentElement.previousElementSibling;
      var linkText = this.textContent.toUpperCase();
  
      if (linkText === "SHOW MORE") {
        linkText = "Show less";
        content.classList.remove("hideContent");
        content.classList.add("showContent");
      } else {
        linkText = "Show more";
        content.classList.remove("showContent");
        content.classList.add("hideContent");
      }
  
      this.textContent = linkText;
    });
  });   