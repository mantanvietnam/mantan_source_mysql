<?php
getHeader();
global $themeSetting;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$themeSetting['Option']['value']['bannerContact'] ?>" alt="">
	</div>

	<div class="container">
		<div class="path path-contact">
			<a href="/">TRANG CHỦ</a> / <span href="">LIÊN HỆ</span>
		</div>
		<div class="row">
			<div class="col-12-col-sm-12 col-md-6 wr-info-contact">
				<div class="title-contact">
					Ligi Doctor Clinic
				</div>
				<!-- <?php echo $themeSetting['Option']['value']['contentContact'] ?> -->
				<p class="va_thongtin"><?php echo @$themeSetting['Option']['value']['titleContact'] ?></p>
				<p class="va_dia_chi"><?php echo @$themeSetting['Option']['value']['addressFooter'] ?></p>
				<p class="so_dien_thoai"><?php echo @$themeSetting['Option']['value']['numberPhoneFooter'] ?></p>
				<p class="va_facebook"><?php echo @$themeSetting['Option']['value']['facebookFooter'] ?></p>
				<p class="va_gmail"><?php echo @$themeSetting['Option']['value']['gmailContact'] ?></p>
				
			</div>
			<div class="col-12-col-sm-12 col-md-6">
				<div class="wr-map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.1486814298987!2d105.81320751526742!3d21.026736085999413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab6e69e3b5c5%3A0xe83f4b2677db9656!2zMTIgUGjhu5EgTmfhu41jIEtow6FuaCwgR2nhuqNuZyBWw7UsIEJhIMSQw6xuaCwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1631518721821!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
		</div>
		<div class="title-cate">
			TƯ VẤN MIỄN PHÍ
		</div>
		<form id="formContact" action="" method="post">
			<div class="row">
				<div class="col-12-col-sm-12 col-md-6">
					<input name="fullName" type="text" placeholder="HỌ VÀ TÊN" required="">
				</div>
				<div class="col-12-col-sm-12 col-md-6">
					<input name="email" type="email" placeholder="EMAIL">
				</div>
			</div>
			<div class="row">
				<div class="col-12-col-sm-12 col-md-12">
					<input name="fone" type="number" placeholder="SỐ ĐIỆN THOẠI">
				</div>
			</div>
			<div class="row">
				<div class="col-12-col-sm-12 col-md-12">
					<textarea name="content" id="" cols="30" rows="6" title="mess" placeholder="Bạn thắc mắc điều gì?"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-12"><button type="submit">Gửi</button></div>
			</div>
		</form>
	</div>
<?php
getFooter();
?>
<?php if($tmpVariable['returnSend']['code']==1){ ?>
<div class="modal"  id="alertMess">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div style="justify-content:center;color:#00771b" class="modal-header">
				<div style="font-size: 22px;text-align:center" class="modal-title">THÔNG BÁO</div>
			</div>
			<div class="modal-body">
				<?php echo @$tmpVariable['returnSend']['mess']; ?>
			</div>
			<div class="modal-footer">
				<button style="font-size: 18px" type="button" class="btn" data-dismiss="modal">Đóng</button>
			</div>

		</div>
	</div>
</div>

<script>
	$('#alertMess').modal('show');
</script>
<?php
} ?>