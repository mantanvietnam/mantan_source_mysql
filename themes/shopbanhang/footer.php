<?php
global $urlThemeActive;
$setting = setting();
global $session;
$infoUser = $session->read('infoUser');

?>

   <footer>
        <section id="section-footer">
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="logo-footer">
                        <img src="<?php echo $urlThemeActive ?>asset/image/logophong.png" alt="">
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-left">
                        <div class="footer-info">
                            <div class="copyright">
                                <strong><?php echo $setting['company'] ?></strong>
                            </div>
                            <div class="footer-info-list">
                                <div class="footer-info-item">
                                    <p><?php echo $setting['address'] ?></p>
                                    <p>ĐT:<span class="blue-text"><?php echo $setting['phone'] ?></span>-Fax:<span class="blue-text"><?php echo $setting['fax'] ?></span></p>
                                </div>

                                <div class="footer-info-item">
                                    <p><span class="blue-text">Giấy chứng nhận đăng ký doanh nghiệp: <?php echo $setting['business'] ?></span></p>
                                    <p><?php echo $setting['side_plan'] ?></p>
                                </div>

                                <div class="footer-info-item">
                                    <p>Tổng đài hỗ trợ (08:00-21:00, miễn phí gọi)</p>  
                                    <p>Gọi mua: <span class="blue-text"><?php echo $setting['call_buy'] ?></span></p>  
                                    <p>Khiếu nại: <span class="blue-text"><?php echo $setting['complain'] ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-center">
                        <div class="menu-footer">
                            <div class="footer-menu-name">
                                <p>Danh mục</p>
                            </div>
                            <ul>
                                 <?php
                                if (!empty(getListLinkWeb(@$setting['id_category']))) {
                                    foreach (getListLinkWeb(@$setting['id_category']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>

                        <div class="menu-footer">
                            <div class="footer-menu-name">
                                <p>Dịch vụ khách hàng</p>
                            </div>
                            <ul>
                                 <?php
                                if (!empty(getListLinkWeb(@$setting['id_service']))) {
                                    foreach (getListLinkWeb(@$setting['id_service']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-right">
                        <div class="footer-social">
                            <div class="footer-menu-name">
                                <p>KẾT NỐI VỚI CHÚNG TÔI</p>
                            </div>
                            <div class="group-social">
                                <ul>
                                    <li><a href="<?php echo $setting['facebook'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/face.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['youtube'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/youtube.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['instagram'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/insta.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['email'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/mail.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="footer-contact">
                            <div class="footer-menu-name">
                                <p>Đăng ký với chúng tôi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- Đăng nhập -->
        <div class="modal-login">
           <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary">
                Launch static backdrop modal
            </button> -->
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 modal-left">
                                    <div class="modal-left-heading">
                                        <p>Xin chào!</p>
                                    </div>

                                    <div class="modal-left-sub">
                                        <p>Đăng nhập hoặc Tạo tài khoản</p>
                                    </div>

                                    <div class="modal-left-login-social">
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-facebook" style="color: #0D6EFD"></i><a href="">Tiếp tục với Facebook</a>
                                        </div>
                                        <div class="login_f gg">
                      <?php
                      global $google_clientId;
                      global $google_clientSecret;
                      global $google_redirectURL;

                      $client = new Google_Client();
                      $client->setClientId($google_clientId);
                      $client->setClientSecret($google_clientSecret);
                      $client->setRedirectUri($google_redirectURL);
                      $client->setApplicationName('Đăng nhập Ezpics');
                      //$client->setApprovalPrompt('force');

                      $client->addScope('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me');

                      $authUrl = $client->createAuthUrl();
                      ?>
                  </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-google" style="color: red"></i><a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL) ?>">Tiếp tục với Google</a>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                        </div>
                                         <div class="row">
              <div class="col-sm-12 text-center mb-2">
                  
              </div> 
            </div>
                                    </div>

                                    <div class="modal-left-bottom">
                                        <p>Chưa có tài khoản ? <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tạo tài khoản</button></p>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 modal-right">
                                    <div class="or-login">
                                        <span>Hoặc tiếp tục bằng</span>
                                    </div>

                                    <form  action="" method="post">
                                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                        
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Số điện thoại">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Mật khẩu">
                                        </div>
                                        <p id="messlogin"></p>
                                        <div class="group-button-login">
                                            <a type="submit" onclick="login()" class="btn btn-primary" >Tiếp tục</a>
                                            <a class="forgotpassword" href="" data-bs-toggle="modal" data-bs-target="#exampleModal3">Quên mật khẩu ?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Đăng ký -->
        <div class="modal-login">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 modal-left">
                                    <div class="modal-left-heading">
                                        <p>Xin chào!</p>
                                    </div>

                                    <div class="modal-left-sub">
                                        <p>Đăng nhập hoặc Tạo tài khoản</p>
                                    </div>

                                    <div class="modal-left-login-social">
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-facebook" style="color: #0D6EFD"></i><a href="">Tiếp tục với Facebook</a>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-google" style="color: red"></i><a href="">Tiếp tục với Google</a>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                        </div>
                                    </div>

                                    <div class="modal-left-bottom">
                                        <p>Đã có tài khoản ? <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng nhập</button></p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 modal-right">
                                    <div class="or-login">
                                        <span>Đăng ký tài khoản</span>
                                    </div>

                                    <form action="" method="post">
                                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Họ và tên">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="emailReg" id="emailReg" placeholder="email">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="passReg" id="passReg" placeholder="Mật khẩu">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="passAgain" id="passAgain" placeholder="Mật khẩu xác thực">
                                        </div>
                                        <p id="messReg"></p>
                                        <a class="btn btn-primary" onclick="register()">Tiếp tục</a>
                                    </form>
                                    

                                    <!-- <div class="email-login">
                                        <span>Đăng nhập bằng email?</span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- quên mật khẩu -->
        <!-- Quên mật khẩu -->
        <div class="modal-login modal-forgotpass">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 modal-right">
                                    <div class="or-login">
                                        <div class="forgot-text-title">
                                            Quên mật khẩu
                                        </div>
                                        <div class="forgot-text">
                                            Bumas sẽ gửi một email tin nhắn có chứa mã xác thực để thay đổi mật khẩu đến địa chỉ email của bạn
                                        </div>
                                    </div>
                                 
                                    <p id="messforgotpassword"></p>
                                    <form action="">
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="exampleCheck1" placeholder="Nhập email">
                                        </div>
                                        <a onclick="forgotpassword()" class="btn btn-primary">Tiếp tục</a>
                                    </form>

                                    <div class="forgot-bottom">
                                        Đã có mật khẩu? <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- mã xác nhân  -->
        <div class="modal-login">
 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 modal-right">
                                <div class="or-login">
                                    <span>Mã xác nhận </span>
                                </div>
                                <p id="messforgotpassword"></p>
                                <form action="">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="code" placeholder="Mã xác nhận ">
                                    </div>
                                    <a onclick="confirm()" class="btn btn-primary">Tiếp tục</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

         <!-- mã xác nhân  -->
        <div class="modal-login">
 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 modal-right">
                                <div class="or-login">
                                    <span>Mã xác nhận </span>
                                </div>
                                <p id="messforgotpassword"></p>
                                <form action="">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="code" placeholder="Mã xác nhận ">
                                    </div>
                                    <p >Bạn khiểm tra Emali lấy mã xác nhận </p>
                                    <a onclick="forgotpassword()" class="btn btn-primary">Tiếp tục</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

         <!-- mật khẩu   -->
        <div class="modal-login">
 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 modal-right">
                                <div class="or-login">
                                    <span>Mật khẩu mới</span>
                                </div>
                                <p id="newpass"></p>
                                <form action="">
                                    <div class="mb-3">
                                        <input type="password" class="form-control" id="password1" placeholder="Mật khẩu mới">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" id="password2" placeholder="Xác nhận mật khẩu mới">
                                    </div>
                                    <a onclick="newpassword()" class="btn btn-primary">Tiếp tục</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
        

    function login(){
        var email = $('#email').val();
        var pass = $('#pass').val();
        console.log(email);
        console.log(pass);
        $.ajax({
            method: "POST",
            data:{email: email,
                  pass:pass,  
                },
            url: "/apis/login",
        })
        .done(function(msg) {
            console.log(msg);
            if(msg.code==1){    
                location.reload();
            }else{
                var html = '<p class="text-danger">'+msg.messages+'</p>';
                document.getElementById("messlogin").innerHTML = html;

            }
           
        });
    }

    function register(){
        var full_name = $('#full_name').val();
        var phone = $('#phone').val();
        var email = $('#emailReg').val();
        var passReg = $('#passReg').val();
        var passAgin = $('#passAgain').val();
        console.log(full_name);
        console.log(phone);
        console.log(email);
        console.log(passReg);
        console.log(passAgin);  
        $.ajax({
            method: "POST",
            data:{
                  full_name: full_name,
                  phone: phone,  
                  email: email,
                  pass: passReg,  
                  passAgain: passAgin,  
                },
            url: "/apis/register",
        })
        .done(function(msg) {
            console.log(msg);
            if(msg.code==1){
                location.reload();
            }else{
                var html = '<p class="text-danger">'+msg.messages+'</p>';
                document.getElementById("messReg").innerHTML = html;

            }
           
        });
    }

    function forgotpassword(){
        var email = $('#exampleCheck1').val();

        var exampleModal3 =  document.getElementById("exampleModal3");
        var exampleModalcode =  document.getElementById("exampleModalcode");

       
        $.ajax({
            method: "POST",
            data:{email: email,
                },
            url: "/apis/forgotpassword",
        })
        .done(function(msg) {
           if(msg.code==1){    
                exampleModal3.style.display = 'none';
                exampleModalcode.style.display = 'block';

                exampleModal3.classList.remove("show");
                exampleModalcode.classList.add("show");
            }else{
                var html = '<p class="text-danger">'+msg.messages+'</p>';
                document.getElementById("messforgotpassword").innerHTML = html;

            }
           
        });
    }

    function confirm(){
        var code = $('#code').val();
          console.log(code);
        var exampleModalpassword =  document.getElementById("exampleModalpassword");
        var exampleModalcode =  document.getElementById("exampleModalcode");

       
        $.ajax({
            method: "POST",
            data:{code: code,
                },
            url: "/apis/confirm",
        })
        .done(function(msg) {
            console.log(msg);
           if(msg.code==1){    
                exampleModalpassword.style.display = 'block';
                exampleModalcode.style.display = 'none';

                exampleModalpassword.classList.add("show");
                exampleModalcode.classList.remove("show");
            }else{
                var html = '<p class="text-danger">'+msg.messages+'</p>';
                document.getElementById("confirm").innerHTML = html;

            }
           
        });
    }
    function newpassword(){
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
          console.log(code);
        var exampleModalpassword =  document.getElementById("exampleModalpassword");
        var exampleModalcode =  document.getElementById("exampleModalcode");

       
        $.ajax({
            method: "POST",
            data:{pass: password1,
                passAgain: password2,
                },
            url: "/apis/newpassword",
        })
        .done(function(msg) {
            console.log(msg);
           if(msg.code==1){    
               location.reload();
            }else{
                var html = '<p class="text-danger">'+msg.messages+'</p>';
                document.getElementById("newpass").innerHTML = html;

            }
           
        });
    }
    
    </script>

    <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/mainplusproduct.js"></script>


</body>
</html>