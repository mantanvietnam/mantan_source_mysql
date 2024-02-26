<?php getHeader();?>
<?php $setting = setting();?>
	<section class="contact_main">
		<!-- <div class="map_main">
			<?php echo @$themeSettings['Option']['value']['map']; ?>
		</div> -->
		<div class="container contact_content" style="padding: 20px 15px 30px 15px">
			<div class="row">
				<div class="col-md-8">
					<h3>Thông tin liên hệ</h3>
					<form action="" method="post">
						<input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Họ và tên</label>
								    <input type="text" class="form-control"  name="name" placeholder="Vui lòng nhập họ và tên">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Số điện thoại</label>
								<input type="text" class="form-control" name="phone" placeholder="Vui lòng nhập số điện thoại">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Vui lòng nhập email">
						</div>
						<div class="form-group">
							<label>Nội dung</label>
							<textarea class="form-control" name="content" placeholder="Vui lòng để lại nội dung liên hệ của bạn"></textarea>
						</div>
						
						<button style="float: right" type="submit" class="btn btn-info"><i class="fab fa-telegram-plane"></i> Gửi</button>
					</form>
				</div>
				<div class="col-md-4">
					<h3>Địa chỉ</h3>
					<p>
						<b>SPA:</b> <?php echo @$setting['nameThamMy']; ?><br>
						<b>Điện thoại CSKH:</b> <?php echo @$setting['hotline']; ?> <br>
						<b>Email CSKH:</b> <?php echo @$setting['linkMail']; ?><br>
						<b>Địa chỉ:</b> <?php echo @$setting['address']; ?>
					</p>
				</div>
			</div>
		</div>
	</section>


	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Thông báo</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p>
						<?php
							
                            echo @$mess;
                        ?>
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
<?php getFooter();?>