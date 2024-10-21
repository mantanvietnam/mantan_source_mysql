$('.banner-silde').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-window-minimize"></i>';
    },

});

var carousel = document.getElementById('carouselExampleIndicators');
var carouselInstance = new bootstrap.Carousel(carousel, {
  interval: 1000,
  pause: 'hover'
});

$(document).ready(function(){
    $('.carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick-prev">Previous</button>',
        nextArrow: '<button type="button" class="slick-next">Next</button>'
    });
});

<script>
    document.querySelector('#navbarDropdown').addEventListener('click', function (event) {
        event.preventDefault() // Ngăn hành động mặc định khi nhấp vào thẻ a
    });
</script>

 // jQuery to handle tab switching
 $(document).ready(function () {
    $('#authTabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});

document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function () {
        const value = this.value;
        this.className = 'form-select status-select ' + value;
    });
});

function showSection(section) {
    var eventTab = document.getElementById('event-tab');
    var ticketTab = document.getElementById('ticket-tab');
    var eventSection = document.getElementById('event-section');
    var ticketSection = document.getElementById('ticket-section');
    
    if (section === 'event') {
        eventTab.classList.add('active');
        ticketTab.classList.remove('active');
        eventSection.style.display = 'block';
        ticketSection.style.display = 'none';
    } else if (section === 'ticket') {
        eventTab.classList.remove('active');
        ticketTab.classList.add('active');
        eventSection.style.display = 'none';
        ticketSection.style.display = 'block';
    }
}

function adjustImage(type) {
    const previewImage = document.getElementById("previewImage");
  
    switch (type) {
      case 'horizontal':
        // Adjust horizontal size
        break;
      case 'vertical':
        // Adjust vertical size
        break;
      case 'zoom':
        // Adjust zoom level
        break;
      case 'aspectRatio':
        // Adjust aspect ratio
        break;
    }
  }

  $(document).ready(function () {
    // Gọi hàm xử lý sự kiện change
    $('#chooseFile').on('change', handleFileSelect);
});

// Hàm xử lý khi chọn file
function handleFileSelect(event) {
    // Lấy file từ input
    var fileInput = document.getElementById('chooseFile');
    var file = fileInput.files[0]; // Lấy file đầu tiên được chọn

    if (file) {
        // Nếu file được chọn, hiển thị tên file
        $("#noFile").text(file.name);
        $(".file-upload").addClass('active');

        // Ghi tên file ra console
        console.log("File đã chọn: " + file.name);
    } else {
        // Nếu không có file nào được chọn, hiển thị thông báo mặc định
        $("#noFile").text("No file chosen...");
        $(".file-upload").removeClass('active');
    }
}



// text-1

