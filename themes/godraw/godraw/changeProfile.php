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
								<span>Thông tin tài khoản</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content-user">
					<div class="content-tab active" id="tab-1">
						<div class="info-form-user">
							<div class="item-frm">
								<div class="icon">
									<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.1714 33.2002C8.22139 33.2002 0.941406 25.9202 0.941406 16.9702C0.941406 8.02022 8.22139 0.740234 17.1714 0.740234C22.7514 0.740234 27.8813 3.55979 30.8813 8.27979V8.29004C31.1213 8.71004 31.2416 9.50977 30.5916 10.0098C30.3616 10.1898 30.0714 10.2798 29.7314 10.2798C29.4614 10.2798 29.2215 10.2302 29.0715 10.1802L29.0615 10.2002L28.9114 10.1201L28.7815 10.0698V10.0498C27.4115 9.3398 25.8615 8.97021 24.3115 8.97021C22.9115 8.97021 21.5115 9.2801 20.2415 9.8501C20.1315 9.9001 20.0013 9.93018 19.8813 9.93018C19.5713 9.93018 19.2813 9.75998 19.1313 9.47998L19.1216 9.45996C19.0116 9.24996 18.9915 9.01004 19.0615 8.79004C19.1315 8.57004 19.2915 8.3898 19.5015 8.2998C20.9915 7.6098 22.6515 7.25 24.3015 7.25C25.7915 7.25 27.3014 7.55012 28.6914 8.12012C25.9514 4.56012 21.6814 2.4502 17.1814 2.4502C9.1814 2.4502 2.67139 8.95996 2.67139 16.96C2.67139 24.96 9.1814 31.4702 17.1814 31.4702C21.1614 31.4702 24.9514 29.84 27.6814 26.98C26.6114 27.42 25.4615 27.6499 24.3015 27.6499C19.3915 27.6499 15.4014 23.66 15.4014 18.75C15.4014 13.84 19.3915 9.8501 24.3015 9.8501C29.2115 9.8501 33.2014 13.84 33.2014 18.75C33.2014 19.22 33.1616 19.6902 33.0916 20.1602C33.0916 20.2102 33.0815 20.2701 33.0715 20.3301C32.8815 21.8401 32.0816 23.5101 31.6116 24.3701C31.3716 24.8301 31.1216 25.2702 30.8616 25.6802C27.8516 30.4002 22.7314 33.2002 17.1714 33.2002ZM24.2915 11.5898C20.3315 11.5898 17.1116 14.81 17.1116 18.77C17.1116 22.73 20.3315 25.9502 24.2915 25.9502C27.9015 25.9502 30.9414 23.2802 31.4114 19.7202H24.2214C23.7314 19.7202 23.3315 19.3201 23.3315 18.8301C23.3315 18.3401 23.7314 17.9399 24.2214 17.9399H31.4314C31.0114 14.3699 27.9015 11.5898 24.2915 11.5898Z" fill="#EC2024"/>
									</svg>
								</div>
								<div class="desc">
									<span class="txt-desc"><?php echo number_format($user->total_coin)?> COIN</span>
								</div>
							</div>

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
										<input type="text" placeholder="Họ tên" name="name" class="txt_filed" value="<?php echo $user->name;?>">
									</div>
								</div>
								
								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-phone"></i>
									</div>
									<div class="desc">
										<input disabled type="text" placeholder="Số điện thoại" name="phone" class="txt_filed" value="<?php echo $user->phone;?>">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-envelope"></i>
									</div>
									<div class="desc">
										<input type="text" placeholder="Email" name="email" class="txt_filed" value="<?php echo $user->email;?>">
									</div>
								</div>

								<div class="item-frm">
									<div class="icon">
										<i class="fa-solid fa-user-secret"></i>
									</div>
									<div class="desc">
										<input type="text" placeholder="Nickname" name="nickname" class="txt_filed" value="<?php echo $user->nickname;?>">
									</div>
								</div>

								
								<div class="item-frm justify-content-center">
									<div class="item-submit">
										<input type="submit" value="ĐỔI THÔNG TIN" class="btn_filed">
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