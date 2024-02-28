<?php
getHeader();
$setting = setting();
global $themeSetting;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$setting['banner1'] ?>" alt="">
	</div>

	<div class="container">
		<div class="path path-contact">
			<a href="/">TRANG CHỦ</a> / <span href="">LIÊN HỆ</span>
		</div>
		<div class="row">
			<div class="col-12-col-sm-12 col-md-6 wr-info-contact">
				
				
				<p class="va_thongtin"><?php echo @$setting['company'] ?></p>
				<p class="va_dia_chi"><?php echo @$setting['address'] ?></p>
				<p class="so_dien_thoai"><?php echo @$setting['hotline'] ?></p>
				<p class="va_facebook"><?php echo @$setting['facebook'] ?></p>
				<p class="va_gmail"><?php echo @$setting['email'] ?></p>
				
			</div>
			<div class="col-12-col-sm-12 col-md-6">
				<div class="wr-map"><?php echo @$setting['map'] ?></div>
			</div>
		</div>
		<div class="title-cate">
			TƯ VẤN MIỄN PHÍ

		</div>
		<p><?php echo @$mess; ?></p>
		<form id="formContact" onsubmit="" action="" method="post" class="form-custom-1 py-3">
                                 <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
			<div class="row">
				<div class="col-12-col-sm-12 col-md-6">
					<input name="name" type="text" placeholder="HỌ VÀ TÊN" required="">
				</div>
				<div class="col-12-col-sm-12 col-md-6">
					<input name="email" type="email" placeholder="EMAIL">
				</div>
			</div>
			<div class="row">
				<div class="col-12-col-sm-12 col-md-12">
					<!-- <input id="phone" name="phone" type="tel" placeholder="SỐ ĐIỆN THOẠI" required> -->
					<input type="tel" id="phone" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="SỐ ĐIỆN THOẠI" required />
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

