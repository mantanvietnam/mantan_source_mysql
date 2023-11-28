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

								<div class="item-frm">
									<div class="icon">
										<i class="fa-brands fa-bitcoin"></i>
									</div>
									<div class="desc">
										<input disabled type="text" placeholder="Điểm tích lũy" name="nickname" class="txt_filed" value="<?php echo number_format($user->total_coin);?>">
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