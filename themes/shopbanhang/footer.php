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
                        <img src="<?php echo @$setting['image_logo'] ?>" alt="">
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 footer-item footer-left">
                        <div class="footer-info">
                            <div class="copyright">
                                <?php echo $setting['company'] ?>
                            </div>
                            <div class="footer-info-list">
                                <div class="footer-info-item">
                                    <p><?php echo $setting['address'] ?></p>
                                    <p>ĐT:<span class="blue-text"><?php echo $setting['phone'] ?></span>
                                        <!-- -Fax:<span class="blue-text"><?php echo $setting['fax'] ?></span></p> -->
                                </div>

                                <div class="footer-info-item">
                                    <p><span class="blue-text">Giấy chứng nhận đăng ký doanh nghiệp: <?php echo $setting['business'] ?></span></p>
                                    <p><?php echo $setting['side_plan'] ?></p>
                                </div>

                                <div class="footer-info-item">
                                    <p>Tổng đài hỗ trợ (08:00-17:00)</p>  
                                    <p>Gọi mua: <span class="blue-text"><?php echo $setting['call_buy'] ?></span></p>  
                                    <p>Hỗ trợ: <span class="blue-text"><?php echo $setting['complain'] ?></span></p>
                                </div>

                                <div class="footer-info-item row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <a href="//www.dmca.com/Protection/Status.aspx?ID=8d5e8353-1592-4e74-9995-353ca496214d" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca_protected_16_120.png?ID=8d5e8353-1592-4e74-9995-353ca496214d"  alt="DMCA.com Protection Status"  style="width: 100%;" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <a href='http://online.gov.vn/Home/WebDetails/112243'><img alt='' title='' src='https://bumas.vn/upload/admin/files/01.png' style="width: 100%;"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 col-12 footer-item footer-center">
                        <div class="menu-footer menu-footer1">
                            <div class="footer-menu-name footer-menu-name1">
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

                        <div class="menu-footer menu-footer2">
                            <div class="footer-menu-name footer-menu-name2">
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

                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 footer-item footer-right">
                        <div class="footer-social">
                            <div class="footer-menu-name">
                                <p>KẾT NỐI VỚI CHÚNG TÔI</p>
                            </div>
                            <div class="group-social">
                                <ul>
                                    <li><a target="_blank" href="<?php echo $setting['facebook'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/face.png" alt=""></a></li>
                                    <li><a target="_blank" href="<?php echo $setting['youtube'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/youtube.png" alt=""></a></li>
                                    <li><a target="_blank" href="<?php echo $setting['instagram'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/insta.png" alt=""></a></li>
                                    <li><a target="_blank" href="<?php echo $setting['email'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/tiktok.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="footer-contact">
                            <div class="footer-menu-name">
                                <p>Đăng ký với chúng tôi</p>
                            </div>
                        </div>

                        <section id="section-blog-contact" class="footer-blog-contact">
                            <div class="title-section-sub">
                                <p>Đăng ký nhận tin để nhận những khuyến mãi hấp dẫn</p>
                            </div>

                            <div class="form-blog-contact">
                                    <div class="input-blog-contact">
                                        <input type="email" name="emailSubscribe" id="emailSubscribe" class="form-control" placeholder="Nhập email của bạn" required>
                                        <button onclick="addSubscribe()" class="btn btn-primary">Đăng ký</button>
                                    </div>

                            </div>
                        </section>
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
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                                        <div class="login-social-item" onclick="loginFB();">
                                            <i class="fa-brands fa-facebook" style="color: #0D6EFD"></i><a href="">Tiếp tục với Facebook</a>
                                        </div>
                                        
                                        <div id="fb-root"></div>
                                        <script type="text/javascript">
                                        //<![CDATA[
                                        window.fbAsyncInit = function() {
                                           FB.init({
                                             appId      : '202676052887175', // App ID
                                             channelURL : '', // Channel File, not required so leave empty
                                             status     : true, // check login status
                                             cookie     : true, // enable cookies to allow the server to access the session
                                             oauth      : true, // enable OAuth 2.0
                                             xfbml      : false  // parse XFBML
                                           });
                                        };
                                        // logs the user in the application and facebook
                                        function loginFB(){
                                            FB.getLoginStatus(function(r){
                                                 if(r.status === 'connected'){
                                                        window.location.href = 'fbconnect.php';
                                                 }else{
                                                    FB.login(function(response) {
                                                            if(response.authResponse) {
                                                          //if (response.perms)
                                                                window.location.href = 'fbconnect.php';
                                                        } else {
                                                          // user is not logged in
                                                        }
                                                 },{scope:'email'}); // which data to access from user profile
                                             }
                                            });
                                        }
                                        // Load the SDK Asynchronously
                                        (function() {
                                           var e = document.createElement('script'); e.async = true;
                                           e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                                           document.getElementById('fb-root').appendChild(e);
                                        }());
                                        //]]>
                                        </script>

                                        <div class="login_f gg">
                                            <?php
                                              global $google_clientId;
                                              global $google_clientSecret;
                                              global $google_redirectURL;

                                              $client = new Google_Client();
                                              $client->setClientId($google_clientId);
                                              $client->setClientSecret($google_clientSecret);
                                              $client->setRedirectUri($google_redirectURL);
                                              $client->setApplicationName('Đăng nhập bumas');
                                              //$client->setApprovalPrompt('force');

                                              $client->addScope('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me');

                                              $authUrl = $client->createAuthUrl();
                                            ?>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-google" style="color: red"></i><a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL) ?>">Tiếp tục với Google</a>
                                        </div>
                                        <!-- <div class="login-social-item">
                                            <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                        </div> -->
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
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Số điện thoại/Email">
                                        </div>

                                        <div class="mb-3 password-container">
                                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Mật khẩu">
                                            <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye-slash"></i></span>
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
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                                            <i class="fa-brands fa-google" style="color: red"></i><a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL) ?>">Tiếp tục với Google</a>
                                        </div>
                                        <!-- <div class="login-social-item">
                                            <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                        </div> -->
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
                                            <input type="text" required="" class="form-control" name="full_name" id="full_name" placeholder="Họ và tên">
                                        </div>

                                        <div class="mb-3">
                                            <input type="number"  required="" class="form-control" name="phone" id="phone" placeholder="Số điện thoại">
                                        </div>

                                        <div class="mb-3">
                                            <input type="email"  required="" class="form-control" name="emailReg" id="emailReg" placeholder="Email">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password"  required="" class="form-control" name="passReg" id="passReg" placeholder="Mật khẩu">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password"  required="" class="form-control" name="passAgain" id="passAgain" placeholder="Nhập lại mật khẩu ">
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
                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
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
        <div class="modal-login modal-forgotpass">  
            <!-- Modal -->
            <div class="modal fade" id="exampleModalcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 modal-right">
                                    <div class="or-login">
                                        <div class="forgot-text-title">
                                            Mã xác nhận 
                                        </div>
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> -->

                                    </div>
                                    <p id="confirm"></p>
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
        
        <!-- Nut bam xác nhận modal -->
         <!-- mã xác nhân  -->
        <div class="modal-login modal-forgotpass">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
                                    <p >Bạn kiểm tra Email lấy mã xác nhận </p>
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
        <div class="modal-login modal-forgotpass">
 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-dismiss="modal">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 modal-right">
                                <div class="or-login">
                                    <div class="forgot-text-title">
                                        Mật khẩu mới
                                    </div>
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


         <!-- mật khẩu   -->
        <div class="modal-login modal-forgotpass">  
            <!-- Modal -->
            <div class="modal fade" id="modalemailSubscribe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 modal-right">
                                    <div class="or-login">
                                        <div class="icon-notification">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/notificationicon.png" alt="">
                                        </div>

                                        <div class="forgot-text-title" id="messSubscribe">
                                            
                                        </div>
                                    </div>
                                    
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
        console.log(phone.length);
        console.log(email);
        console.log(passReg);
        console.log(passAgin);

        if(phone.length ==10){  
            if(kiemTraEmailHopLe(email)){
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
            }else{
                    var html = '<p class="text-danger">Email không đúng</p>';
                    document.getElementById("messReg").innerHTML = html;
            }
        }else{
             var html = '<p class="text-danger">Số điên thoại không đúng</p>';
                    document.getElementById("messReg").innerHTML = html;
        }
    }

    function kiemTraEmailHopLe(email) {
  // Biểu thức chính quy cho kiểm tra email cơ bản
  var bieuThucChinhQuy = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  // Kiểm tra email với biểu thức chính quy
  return bieuThucChinhQuy.test(email);
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

    function addSubscribe(){
        var email = $('#emailSubscribe').val();
          console.log(code);
        var modalemailSubscribe =  document.getElementById("modalemailSubscribe");
        var addClass =  document.getElementById("addClass");


       
        $.ajax({
            method: "POST",
            data:{email: email,
                },
            url: "/apis/addSubscribeAPI",
        })
        .done(function(msg) {
            console.log(msg);
                document.getElementById("messSubscribe").innerHTML = msg.mess;
                modalemailSubscribe.style.display = 'block';
                modalemailSubscribe.classList.add("show");
                addClass.classList.add("show");
                addClass.classList.add("modal-backdrop");
                addClass.classList.add("fade");

           
        });
    }
    
    </script>
 
    <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/mainplusproduct.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/review.js"></script>
    <div id="addClass"></div>



</body>
</html>