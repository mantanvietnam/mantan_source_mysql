$(document).ready(function () {
    const urlPrev = "/themes/training/assets/img/prev.svg";
    const urlNext = "/themes/training/assets/img/next.svg";
    $('.my-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: `<button class="slider-nav slider-prev-arr d-none d-lg-block"><img src='${urlPrev}' /></button>`,
        nextArrow: `<button class="slider-nav slider-next-arr d-none d-lg-block"><img src='${urlNext}' /></button>`,


        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    //my-slider-more-courses
    $('.my-slider-more-courses').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: `<button class="slider-nav slider-prev-arr d-none d-lg-block"><img src='${urlPrev}' /></button>`,
        nextArrow: `<button class="slider-nav slider-next-arr d-none d-lg-block"><img src='${urlNext}' /></button>`,


        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    //Event thay đổi nội dung trang
    if (document.getElementById("content1") && document.getElementById("content2")) {
        document.getElementById("content1").addEventListener('click', function (e) {
            this.classList.add('active')
            $("#content2").removeClass('active');
            $(".nav-content .course-detail").removeClass('d-none');
            $(".nav-content .course-rate").addClass('d-none');
        })
        document.getElementById("content2").addEventListener('click', function (e) {
            this.classList.add('active')
            $("#content1").removeClass('active');
            $(".nav-content .course-detail").addClass('d-none');
            $(".nav-content .course-rate").removeClass('d-none');
        })
    }
    //Event check rate btn
    $(".course-rate .btn-rate-overlay button").click(function (e) {
        $(".course-rate .btn-rate-overlay button").removeClass('choose')
        $(this).addClass('choose');
        let value = $(this).attr("btn-value");
        $(`input.rating`).attr('checked', false);
        $(`input.rating.rate${value}`).attr('checked', true);
    });

    let index2 = 0;
    let inputHidden = $(".input-hidden input");
    for (const item of inputHidden) {
        index2++
    }
    if (index2 != 0) {
        let inputs = $(".input-hidden input");
        let totalQues = 0;
        let checkQues = 0;
        for (const input of inputs) {
            // console.log(input.value);
            totalQues++;
            if (input.checked) {
                checkQues++;
            }
            // console.log(input.getAttribute('checked'));
        }
        totalQues = totalQues / 4;
        document.getElementById('progress-text-id').innerHTML = `0/${totalQues}`
    }

    $(".input-hidden input").change(function (e) {
        let inputs = $(".input-hidden input");
        let totalQues = 0;
        let checkQues = 0;
        for (const input of inputs) {
            // console.log(input.value);
            totalQues++;
            if (input.checked) {
                checkQues++;
            }
            // console.log(input.getAttribute('checked'));
        }
        totalQues = totalQues / 4;
        console.log(totalQues, checkQues);

        let progress = checkQues / totalQues;
        console.log(progress);
        let progress_bar = $(".progress-test .progress-bar");
        document.getElementById('progress-text-id').innerHTML = `${checkQues}/${totalQues}`
        progress_bar[0].style.width = `${progress * 100}%`;
    });

    $(".question b").click(function (e) {
        // console.log(this);
        let numQues = $(this).attr('ques-number');
        let ques_value = this.innerHTML.trim();
        $(`.question.ques-${numQues} b`).removeClass('choose')
        $(this).addClass('choose');
        $(`#ques-${numQues}-value-${ques_value}`).attr('checked', true);

        //////
        let inputs = $(".input-hidden input");
        let totalQues = 0;
        let checkQues = 0;
        for (const input of inputs) {
            // console.log(input.value);
            totalQues++;
            if (input.checked) {
                checkQues++;
            }
            // console.log(input.getAttribute('checked'));
        }
        totalQues = totalQues / 4;
        console.log(totalQues, checkQues);

        let progress = checkQues / totalQues;
        console.log(progress);
        let progress_bar = $(".progress-test .progress-bar");
        document.getElementById('progress-text-id').innerHTML = `${checkQues}/${totalQues}`
        progress_bar[0].style.width = `${progress * 100}%`;
    });

    $(".submit-test button").click(function (e) {
        console.log("submit");
        $(".form-contain-question").submit()
    });
    // Update the count down every 1 second
    if (document.getElementById("span-minute")) {
        var x = setInterval(function () {
            let minute = document.getElementById("span-minute")
            let second = document.getElementById("span-second")

            let minuteVal = Number(minute.innerHTML);
            let secondVal = Number(second.innerHTML);

            if (secondVal == 0) {
                second.innerHTML = 60;
                minute.innerHTML = --minuteVal
            } else {
                minute.innerHTML = minuteVal;
                second.innerHTML = --secondVal;
            }

            // Display the result in the element with id="demo"

            // If the count down is finished, write some text
            if (minuteVal == 0 && secondVal == 0) {
                $(".form-contain-question").submit()
            }
        }, 1000);
    }







    // FormLogin
    $("#sign .nav-item").click(function (e) {
        $("#sign .nav-item").removeClass('active');
        $(this).addClass('active');
        let type = $(this).attr('sign-with');
        let input = document.querySelector(".dynamic-input input");
        let label = document.querySelector(".dynamic-input label");
        if (type == "phone") {
            console.log("OK");
            input.setAttribute("type", "text")
            input.setAttribute("name", "phone")
            label.innerHTML = "Số điện thoại"
            input.setAttribute("placeholder", "Nhập số điện thoại của bạn")
        } else if (type == "email") {
            label.innerHTML = "Địa chỉ Email"
            input.setAttribute("type", "email")
            input.setAttribute("name", "email")
            input.setAttribute("placeholder", "Nhập địa chỉ email của bạn")
        }

    });

    $("#updateCheck").click(function (e) {
        console.log(this.checked);
        if (this.checked) {
            console.log($(".form-contain form input"));
            $(".form-contain form input").prop("disabled", false)
            $(".form-contain form select").prop("disabled", false)
            $(".form-contain form button").prop("disabled", false)
            $("#updateCheckSpan b").removeClass("text-danger")
            $("#updateCheckSpan b").addClass("text-success")
        } else {
            console.log($(".form-contain form input"));
            $(".form-contain form input").prop("disabled", true)
            $(".form-contain form select").prop("disabled", true)
            $(".form-contain form button").prop("disabled", true)
            $("#updateCheckSpan b").addClass("text-danger")
            $("#updateCheckSpan b").removeClass("text-success")
        }
    });



    
    let select2 = 0
    for (const index of $('.js-example-basic-single')) {
        select2++
    }
    console.log(select2);
    if (select2 != 0) {
        $('.js-example-basic-single').select2();
    }
});

