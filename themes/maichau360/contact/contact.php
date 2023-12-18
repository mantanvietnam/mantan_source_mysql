<?php
session_start();
getHeader();
?>
    <main class="bg-pt py-4">
        <?php if (isset($_SESSION['contactSubmit'])): ?>
            <?php if ($_SESSION['contactSubmit'] == true): ?>
                <div class="container">
                    <div class="alert alert-success" role="alert">
                        Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi trong thời gian sớm nhất 
                    </div>
                </div>
                <?php
                $_SESSION['contactSubmit'] = false;
            endif;
        endif;
        ?>
        <section class="section-heading lien-he-heading">
            <h3 class="text-uppercase text-center my-5">Liên hệ</h3>
        </section>
        <section id="lien-he-contain">
            <div class="background">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-12 col-lg-7 h-100">
                            <section class="lien-he-form h-100">
                                <form id="formContact" onsubmit="" action="<?= $routesPlugin["contact"] ?>"
                                      method="post"
                                      class="form-custom-1 py-3">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <div class="card h-100">
                                        <div class="card-body p-lg-5">
                                            <h3 CLASS="fs-2 mb-5">Thông tin liên hệ</h3>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <input name="fullname" type="text" class="form-control"
                                                           placeholder="Tên"
                                                           required>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input name="email" type="email" class="form-control"
                                                           placeholder="Email"
                                                           required>
                                                </div>
                                                <div class="col-12">
                                                    <input name="phone_number" type="tel" class="form-control"
                                                           placeholder="Số điện thoại"
                                                           required>
                                                </div>
                                                <div class="col-12">
                                                    <input name="subject" type="text" class="form-control"
                                                           placeholder="Chủ đề"
                                                           required>
                                                </div>
                                                <div class="col-12">
                                                        <textarea name="content" class="form-control" id="" rows="3"
                                                                  style="height: 170px;"
                                                                  placeholder="Nội dung"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center capcha">
                                                        <span style="" class="">Nhập mã xác nhận:</span>
                                                        <input type="text" id="input_capcha"
                                                               class="form-control mx-3">
                                                        <div class="capcha-range bg-black bg-opacity-25 p-2">
                                                            <span style="user-select: none"
                                                                  class="text-black">56h2dg62</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button id="formBTNSubmit" class="btn button-submit-custom">
                                                        Gửi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                        <div class="col-12 col-lg-5">
                            <section class="contact-info">
                                <div class="card contain">
                                    <div class="card-body p-lg-5">
                                        <h3>Liên hệ chúng tôi</h3>
                                        <div class="info-list">
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="<?= $urlThemeActive ?>assets/lou_icon/icon-location-white.svg"
                                                        class="me-3"
                                                        alt="">
                                                    <span>
                                                        <?= $contactSite["address"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="<?= $urlThemeActive ?>assets/lou_icon/icon-phone-white.svg"
                                                        class="me-3"
                                                        alt="">
                                                    <span>
                                                        <?= $contactSite["phone"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-email.svg"
                                                         class="me-3" alt="">
                                                    <span>
                                                        <?= $contactSite["email"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-global.svg"
                                                         class="me-3" alt="">
                                                    <span>
                                                        https://maichau360.vn/
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        window.onload = function () {
            function generateCaptcha() {
                let captchaChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                let capcha = "";
                for (let i = 0; i < 8; i++) {
                    capcha += captchaChars.charAt(Math.floor(Math.random() * captchaChars.length));
                }
                return capcha;
            }

            let capcha = generateCaptcha();


            document.querySelector(".capcha-range span").innerHTML = capcha;


            document.getElementById("formContact").onsubmit = function () {
                let inputVal = document.getElementById("input_capcha").value;
                console.log(inputVal);
                if (inputVal == capcha) {
                    document.getElementById("formContact").submit();
                } else {
                    alert("Hãy nhập đúng mã capcha!!!")
                    return false;
                }
            }
        }
    </script>

<?php
getFooter();


