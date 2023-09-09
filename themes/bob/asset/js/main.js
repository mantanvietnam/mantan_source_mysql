$(document).ready(function() {
    // Độ cao tối thiểu để thay đổi màu
    var scrollHeight = 200;

    // Lắng nghe sự kiện scroll của cửa sổ
    $(window).scroll(function() {
        // Lấy vị trí hiện tại khi cuộn
        var scrollY = $(this).scrollTop();

        // Kiểm tra nếu cuộn đủ độ cao cố định, thay đổi màu sắc
        if (scrollY >= scrollHeight) {
            $("#menu").css("background-color", "#f00"); // Thay đổi màu sắc tại đây
        } else {
            $("#menu").css("background-color", "#ccc"); // Màu sắc mặc định
        }
    });

    // search
    $('#section-search').hide();
    $(".menu-header-right .icon-glass").click(function(){
        console.log('a');
        $('#section-search').fadeToggle();
    });

});



    function imageZoom(imgID, resultID) {
    var img, lens, result, cx, cy;
    document.getElementById('myresult').style.display= "block";
    img = document.getElementById(imgID);
    result = document.getElementById(resultID);
    /*create lens:*/
    lens = document.createElement("DIV");
    lens.setAttribute("class", "img-zoom-lens");
    
    /*insert lens:*/
    img.parentElement.insertBefore(lens, img);
    /*calculate the ratio between result DIV and lens:*/
    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;
    /*set background properties for the result DIV:*/
    result.style.backgroundImage = "url('" + img.src + "')";
    result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
    /*execute a function when someone moves the cursor over the image, or the lens:*/
    lens.addEventListener("mousemove", moveLens);
    img.addEventListener("mousemove", moveLens);
    /*and also for touch screens:*/
    lens.addEventListener("touchmove", moveLens);
    img.addEventListener("touchmove", moveLens);
    function moveLens(e) {
        var pos, x, y;
        /*prevent any other actions that may occur when moving over the image:*/
        e.preventDefault();
        /*get the cursor's x and y positions:*/
        pos = getCursorPos(e);
        /*calculate the position of the lens:*/
        x = pos.x - (lens.offsetWidth / 2);
        y = pos.y - (lens.offsetHeight / 2);
        /*prevent the lens from being positioned outside the image:*/
        if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
        if (x < 0) {x = 0;}
        if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
        if (y < 0) {y = 0;}
        /*set the position of the lens:*/
        lens.style.left = x + "px";
        lens.style.top = y + "px";
        /*display what the lens "sees":*/
        result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
    }
    function getCursorPos(e) {
        var a, x = 0, y = 0;
        e = e || window.event;
        /*get the x and y positions of the image:*/
        a = img.getBoundingClientRect();
        /*calculate the cursor's x and y coordinates, relative to the image:*/
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /*consider any page scrolling:*/
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return {x : x, y : y};
    }
    }

    function zoomOut(){
    document.getElementById('myresult').style.display= "none";
    }

    // Chi tiết catalogue
    TweenLite.set(".pageBg", {xPercent: -50, yPercent: -50});
    TweenLite.set(".pageWrapper", {left: "50%", perspective: 1000 });
    TweenLite.set(".page", {transformStyle: "preserve-3d"});
    TweenLite.set(".back", {rotationY: -180});
    TweenLite.set([".back", ".front"], {backfaceVisibility: "hidden"});


    $(".page").click(
        function() {
            console.log('aa');
            if (pageLocation[this.id] === undefined || pageLocation[this.id] == "right") {
                zi = ($(".left").length) + 1;
                TweenMax.to($(this), 1, {force3D: true, rotationY: -180, transformOrigin: "-1px top", className: '+=left', z: zi, zIndex: zi});
                TweenLite.set($(this), {className: '-=right'});
                pageLocation[this.id] = "left";
            } else {
                zi = ($(".right").length) + 1;
                TweenMax.to($(this), 1, {force3D: true, rotationY: 0, transformOrigin: "left top", className: '+=right', z: zi, zIndex: zi
                });
                TweenLite.set($(this), {className: '-=left'});
                pageLocation[this.id] = "right";
            }
        }
    );

    $(".front").hover(
        function() {
            TweenLite.to($(this).find(".pageFoldRight"), 0.3, {width: "50px", height: "50px", backgroundImage: "linear-gradient(45deg,  #fefefe 0%,#f2f2f2 49%,#ffffff 50%,#ffffff 100%)"});
        },
        function() {
            TweenLite.to($(this).find(".pageFoldRight"), 0.3, {width: "0px", height: "0px"});
        }
    );

    $(".back").hover(
        function() {
            TweenLite.to($(this).find(".pageFoldLeft"), 0.3, {width: "50px", height: "50px", backgroundImage: "linear-gradient(135deg,  #ffffff 0%,#ffffff 50%,#f2f2f2 51%,#fefefe 100%)"		});
        },
        function() {
            TweenLite.to($(this).find(".pageFoldLeft"), 0.3, {width: "0px", height: "0px"});
        }
    )

    var pageLocation = [],
    lastPage = null;
    zi = 0;