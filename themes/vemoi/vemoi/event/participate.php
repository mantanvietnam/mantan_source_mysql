<?php 
    getHeader();
    global $settingThemes;
    global $session;
    $info = $session->read('infoUser');
?>
<main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="back d-flex">
                    <a href="/detailevent/<?php echo $infoEvent->slug;?>.html"><i class="fa-solid fa-chevron-left"></i></a>
                    <p>Đăng kí tham gia</p>
                </div>
                <div class="step">
                    <div class="progress-container">
                        <div class="step-container">
                            <a href="" class="step-link active hot">
                                <div class="step step1">
                                    <span class="step-number step-number-1">1</span>
                                </div>
                            </a>
                            <div class="step-line"></div>
                            <a href="" class="step-link">
                                <div class="step">
                                    <span class="step-number">2</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="form pt-3 pb-3">
                <div class="form-container">
                    <form id="registerForm" method="post">
                        <p><?=$mess?></p>
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Họ tên đầy đủ *</label>
                                <input class="form-control" type="text" id="name" name="name" value="<?php echo @$info['name'];?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone">Điện thoại *</label>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo @$info['phone'];?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo @$info['email'];?>">
                            </div>

                            <div class="col-md-6">
                                <label for="city">Bạn đến từ tỉnh/thành phố nào?</label>
                                <input class="form-control" type="text" id="city" name="city" placeholder="">
                            </div>

                            <div class="col-md-6">
                                <label for="sex">Giới tính</label>
                                <select id="sex" name="sex" class="form-select">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="date">Ngày sinh</label>
                                <input class="form-control" type="date" id="date" name="date">
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Đăng ký thông tin</button>
                    </form>
                </div>
            </div>
        </section>

</main>
<?php getFooter();?>