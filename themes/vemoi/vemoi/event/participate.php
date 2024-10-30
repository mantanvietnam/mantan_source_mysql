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
                    <a href="./event.html"><i class="fa-solid fa-chevron-left"></i></a>
                    <p>Đăng kí tham gia</p>
                </div>
                <div class="step">
                    <div class="progress-container">
                        <div class="step-container">
                            <a href="#" class="step-link active hot">
                                <div class="step step1">
                                    <span class="step-number step-number-1">1</span>
                                </div>
                            </a>
                            <div class="step-line"></div>
                            <a href="./create.html" class="step-link">
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
                        <div class="form-row">
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <input type="hidden" value="<?php echo $info['id'];?>" name="id_member">
                    
                            <div class="form-group">
                                <label for="fullName">Tên đầy đủ *</label>
                                <input type="text" id="fullName" name="name" placeholder="Tên đầy đủ" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" placeholder="email.com" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- <div class="form-group">
                                <label for="nationality">Quốc tịch *</label>
                                <input type="text" id="nationality" name="nationality" placeholder="Việt Nam" required>
                            </div> -->
                            <div class="form-group">
                                <label for="city">Tỉnh/Thành phố *</label>
                                <input type="text" id="city" name="city" placeholder="Tỉnh/Thành Phố" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="sex">Giới tính *</label>
                                <input type="text" id="sex" name="sex" placeholder="Nam/Nữ" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Ngày sinh *</label>
                                <input type="date" id="date" name="date" required>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">Đăng ký thông tin</button>
                    </form>
                </div>
            </div>
        </section>

</main>
<?php getFooter();?>