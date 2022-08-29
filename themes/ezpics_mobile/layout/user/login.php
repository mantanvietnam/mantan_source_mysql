<?php 
	global $urlThemeActive;
?>
<div class="content-account">
	<div class="content">
		<div class="logo text-center"><img src="<?php echo $urlThemeActive;?>images/logo.png" class="img-fluid" alt=""></div>
		<div class="tab-account">
			<ul>
				<li><a href="javascript:void(0)" data-tab="acc-1" class="active">đăng nhập</a></li>
				<li><a href="javascript:void(0)" data-tab="acc-2" onclick="$('.step-register').addClass('active');">đăng ký</a></li>
			</ul>
		</div>
		<div class="content-tab-account">
			<div class="tab-content active" id="acc-1">
				<div class="frm-account">
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-1.png" class="img-fluid" alt="">
						<input type="text" id="login_phone" value="" placeholder="Số điện thoại" class="txt_field">
					</div>
					<div class="item-frm m-0">
						<img src="<?php echo $urlThemeActive;?>images/ac-2.png" class="img-fluid" alt="">
						<input type="password" placeholder="Mật khẩu" class="txt_field" id="login_pass" value="">
						<img src="<?php echo $urlThemeActive;?>images/eye.svg" class="img-fluid show-pass" alt="" toggle="#password">
					</div>
					<div class="item-frm text-center frm-fogot m-0">
						<p><a href="javascript:void(0)" onclick="$('.step-1').addClass('active');">Quên mật khẩu?</a></p>
					</div>
					<div class="item-frm text-center">
						<input type="button" value="ĐĂNG NHẬP" class="btn_field" onclick="checkLogin();">
					</div>
					<!--
					<div class="item-frm text-center">
						<p>Hoặc</p>
					</div>
					<div class="item-frm text-center">
						<ul>
							<li><a href=""><img src="<?php echo $urlThemeActive;?>images/google.png" class="img-fluid" alt=""><span>Tiếp tục với Google</span></a></li>
							<li><a href=""><img src="<?php echo $urlThemeActive;?>images/facebook.png" class="img-fluid" alt=""><span>Tiếp tục với Facebook</span></a></li>
						</ul>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="step-forgot step-register">
	<div class="back-step" onclick="$(this).closest('.step-forgot').removeClass('active');"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/arrow-back.png" class="img-fluid" alt=""></a></div>

	<div class="content">
		<div class="logo text-center"><img src="<?php echo $urlThemeActive;?>images/logo.png" class="img-fluid" alt=""></div>
		<div class="tab-account">
			<ul>
				<li><a href="javascript:void(0)" data-tab="acc-1" onclick="$(this).closest('.step-forgot').removeClass('active');">đăng nhập</a></li>
				<li><a href="javascript:void(0)" data-tab="acc-2" class="active">đăng ký</a></li>
			</ul>
		</div>
		<div class="content-tab-account">
			
			<div class="tab-content active" id="acc-2">
				<div class="frm-account">
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-1.png" class="img-fluid" alt="">
						<input type="text" placeholder="Họ tên" id="reg_full_name" value="" class="txt_field">
					</div>
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-1.png" class="img-fluid" alt="">
						<input type="text" placeholder="Email" id="reg_email" value=""  class="txt_field">
					</div>
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-1.png" class="img-fluid" alt="">
						<input type="text" placeholder="Số điện thoại" value=""  id="reg_phone" class="txt_field">
					</div>
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-2.png" class="img-fluid" alt="">
						<input type="password" id="reg_pass" value=""  placeholder="Mật khẩu" class="txt_field" id="password_1">
						<img src="<?php echo $urlThemeActive;?>images/eye.svg" class="img-fluid show-pass" alt="" toggle="#password_1">
					</div>
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-2.png" class="img-fluid" alt="">
						<input type="password" value="" id="reg_pass_again" placeholder="Nhập lại mật khẩu" class="txt_field" id="password_2">
						<img src="<?php echo $urlThemeActive;?>images/eye.svg" class="img-fluid show-pass" alt="" toggle="#password_2">
					</div>
					<div class="item-frm text-center">
						<input type="text" placeholder="Nhập mã giới thiệu (nếu có) để nhận ưu đãi" class="txt_field code-member" id="affiliate">
					</div>
					<div class="item-frm text-center">
						<input type="button" onclick="regUser();" value="ĐĂNG ký" class="btn_field">
					</div>
					<!--
					<div class="item-frm text-center">
						<p>Hoặc</p>
					</div>
					<div class="item-frm text-center">
						<ul>
							<li><a href=""><img src="<?php echo $urlThemeActive;?>images/google.png" class="img-fluid" alt=""><span>Tiếp tục với Google</span></a></li>
							<li><a href=""><img src="<?php echo $urlThemeActive;?>images/facebook.png" class="img-fluid" alt=""><span>Tiếp tục với Facebook</span></a></li>
						</ul>
					</div>
					-->
					<div class="policy text-center">
						Bằng việc đăng ký, bạn đã đồng ý với <br> <a href="">Điều khoản dịch vụ</a> & <a href="">Chính sách riêng tư</a> của Ezpics
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="step-forgot step-1">
	<div class="back-step" onclick="$(this).closest('.step-forgot').removeClass('active');"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/arrow-back.png" class="img-fluid" alt=""></a></div>
	<div class="content">
		<div class="logo text-center"><img src="<?php echo $urlThemeActive;?>images/logo.png" class="img-fluid" alt=""></div>
		<div class="tab-account">
			<ul>
				<li><a href="javascript:void(0)" class="active">QUÊN MẬT KHẨU</a></li>
			</ul>
		</div>
		<div class="content-tab-account">
			<div class="tab-content-step">
				<div class="frm-account">
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-1.png" class="img-fluid" alt="">
						<input type="text" placeholder="Email" class="txt_field">
					</div>
					<div class="item-frm text-center frm-submit">
						<input type="submit" value="TIẾP TỤC" class="btn_field" onclick="$('.step-2').addClass('active');">
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>
<div class="step-forgot step-2">
	<div class="back-step" onclick="$(this).closest('.step-forgot').removeClass('active');"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/arrow-back.png" class="img-fluid" alt=""></a></div>
	<div class="content">
		<div class="logo text-center"><img src="<?php echo $urlThemeActive;?>images/logo.png" class="img-fluid" alt=""></div>
		<div class="tab-account">
			<ul>
				<li><a href="javascript:void(0)" class="active">xác nhận địa chỉ email</a></li>
			</ul>
		</div>
		<div class="content-tab-account">
			<div class="tab-content-step">
				<div class="frm-account">
					<div class="item-frm">
						<div class="desc">
							Vui lòng lập mã xác nhận đã được gửi về email: <strong>crypto@gmail.com</strong>. Mã xác nhận sẽ hết hạn trong vòng 30 phút.
						</div>
					</div>
					<div class="item-frm">
						<img src="<?php echo $urlThemeActive;?>images/ac-2.png" class="img-fluid" alt="">
						<input type="text" placeholder="Nhập mã xác nhận" class="txt_field">
					</div>
					<div class="re-code text-center">
						<a href="">Chưa nhận được mã?</a><span>Gửi lại sau <label class="count-time" id="timer">60</label>s</span>
					</div>
					<div class="item-frm text-center frm-submit">
						<input type="submit" value="XÁC NHẬN" class="btn_field">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>