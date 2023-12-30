<?php getHeader();global $settingThemes;?>
<style>
	footer {
		display: none;
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="wrapper-user">
				<div class="head-tab text-center">
					<ul>
						<li>
							<a href="javascript:void(0)" data-tab="tab-1" class="active">
								<svg xmlns="http://www.w3.org/2000/svg" width="529" height="61" viewBox="0 0 529 61" fill="none">
									<path d="M528.161 60.7202H0.53125V30.6699C0.53125 14.1599 13.9113 0.779785 30.4213 0.779785H498.271C514.781 0.779785 528.161 14.1599 528.161 30.6699V60.7202Z" fill="#0065F7"/>
								</svg>
								<span>Đăng ký</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content-user">
					<div class="content-tab active" id="tab-1">
						<div class="info-form-user">
							<form enctype="multipart/form-data" method="post" action="">
              					<input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              					<div class="item-frm">
              						<?php echo $mess;?>
              					</div>
								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-user"></i>
									</div>
									<div class="desc">
										<input type="text" name="name" required class="txt_filed" placeholder="Họ tên">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-user-secret"></i>
									</div>
									<div class="desc">
										<input type="text" name="nickname" required class="txt_filed" placeholder="Bút danh">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-envelope"></i>
									</div>
									<div class="desc">
										<input type="text" name="email" required class="txt_filed" placeholder="Email">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-phone"></i>
									</div>
									<div class="desc">
										<input type="text" name="phone" required class="txt_filed" placeholder="Số điện thoại">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-lock"></i>
									</div>
									<div class="desc">
										<input type="password" name="password" required class="txt_filed" placeholder="Mật khẩu">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-lock"></i>
									</div>
									<div class="desc">
										<input type="password" name="password_again" required class="txt_filed" placeholder="Nhập lại mật khẩu">
									</div>
								</div>

								<div class="item-frm">
                                    <div class="check-policy">
                                        <input type="checkbox" class="inp_check" id="1002" required value="1">
                                        <label for="1002">Chấp nhận Điều khoản sử dụng và Chính sách quyền riêng tư</label>
                                    </div>
                                </div>

								<div class="item-frm justify-content-center">
									<div class="item-submit">
										<input type="button" value="ĐĂNG KÝ" class="btn_filed" onclick="this.form.submit(); this.disabled=true; this.value='Loading ...';">
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
</main>
<?php getFooter();?>