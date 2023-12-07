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
								<span>Đăng ảnh</span>
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
								<div class="item-frm mb-3">
									<div class="desc">
										<p>Mã đơn hàng</p>
										<input type="number" placeholder="" min="1" name="order_id" value="<?php echo (int) @$_GET['order_id'];?>" class="txt_filed" required>
									</div>
								</div>

								<div class="item-frm mb-3">
									<div class="desc">
										<p>Tên ảnh</p>
										<input type="text" placeholder="" name="name" value="" class="txt_filed" required>
									</div>
								</div>

								<div class="item-frm mb-3">
									<div class="desc">
										<p>Chọn ảnh để đăng</p>
										<input type="file" placeholder="" name="image" value="" class="txt_filed" required>
										<div class="image-rule">
											* Bạn có quyền đăng tác phẩm của mình lên phòng tranh chung khi có Mã đơn hàng đã trải nghiệm dịch vụ. <br>
											* Bạn nên đăng tác phẩm và không nên đăng nội dung không phù hợp vì chúng tôi buộc phải xoá nội dung này.
										</div>
									</div>
								</div>

								<div class="item-frm mb-3">
									<div class="desc">
										<p>Mô tả về ảnh</p>
										<textarea rows="5" style="width: 100%;" name="description"></textarea>
									</div>
								</div>
								
								<div class="item-frm justify-content-center">
									<div class="item-submit">
										<input type="submit" value="ĐĂNG ẢNH" class="btn_filed">
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