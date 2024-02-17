<?php
global $themeSetting;
global $urlHomes;
?>
	<div class="container-fluid set-pd-0 footer">
		<div class="container">
			<div class="row">
				<div class="offset-lg-1 col-12 col-sm-12 col-md-12 col-lg-10 wr-logo-foter">
					<img src="<?php echo @$themeSetting['Option']['value']['logo'] ?>" alt="">
				</div>
			</div>
			<div class="row text-footer row-mobile-reverse">
				<div class="offset-lg-1 col-sm-12 col-md-12 col-lg-7">
					<div class="footer-title">
						<?php echo @$themeSetting['Option']['value']['titleFooter'] ?>
					</div>
					<!-- <?php echo @$themeSetting['Option']['value']['contentFooterIndex'] ?> -->
					<p class="va_thongtin"><?php echo @$themeSetting['Option']['value']['titleContact'] ?></p>
					<p class="va_dia_chi"><?php echo @$themeSetting['Option']['value']['addressFooter'] ?></p>
					<p>Hotline: <a class="so_dien_thoai"><?php echo @$themeSetting['Option']['value']['numberPhoneFooter'] ?></a></p>
					<p class="va_facebook"></p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-3">
					<?php 
					$linkweb = getListLinkWeb($themeSetting['Option']['value']['idLinkFooter']);
					if(!empty($linkweb)) {
						foreach ($linkweb as $key => $value) { ?>
							<p><a href="<?php echo @$value['link'] ?>"><?php echo @$value['name'] ?></a></p>
						<?php
						}
					} ?>
				</div>
			</div>
			<div class="row license">
				<div class="col-12">
					<center>©2020 Ligi Doctor Clinic - All rights reserved.</center>
				</div>
			</div>
		</div>
	</div>
	<div class="wr-fix-conact">
		<div class="box-hotline-fix">
			<a href="tel:<?php echo @$themeSetting['Option']['value']['hotline'] ?>">
				<img src="<?php echo $urlThemeActive ?>/assets/images/Hotline.png" alt="">
				<span><?php echo @$themeSetting['Option']['value']['hotline'] ?></span>
			</a>
		</div>
		<div class="box-chat-fix">
			<a href="<?php echo @$themeSetting['Option']['value']['chat'] ?>">
				<img src="<?php echo $urlThemeActive ?>/assets/images/Chat.png" alt="">
				<span>CHAT NGAY</span>
			</a>
		</div>
		<div class="box-set-order">
			<a href="javascript:void(0);" data-toggle="modal" data-target="#modalSetOrder">
				<img src="<?php echo $urlThemeActive ?>/assets/images/set1.png" alt="">
				<span>ĐẶT HẸN</span>
			</a>
		</div>
	</div>
	<div class="wr-fix-tool-bar">
		<div class="container box-fix-tool-bar-contact">
			<a href="javascript:void(0);" data-toggle="modal" data-target="#modalSetOrder"><img src="<?php echo $urlThemeActive ?>/assets/images/LichMobileFix.png" alt="">ĐẶT HẸN</a>
			<a href="tel:<?php echo @$themeSetting['Option']['value']['hotline'] ?>"><img src="<?php echo $urlThemeActive ?>/assets/images/PhoneMobileFix.png" alt=""><?php echo @$themeSetting['Option']['value']['hotline'] ?></a>
			<a href="<?php echo @$themeSetting['Option']['value']['chat'] ?>"><img src="<?php echo $urlThemeActive ?>/assets/images/ChatMobileFix.png" alt="">CHAT NGAY</a>
		</div>
		<div class="container box-fix-tool-bar-cate">
			<a href="/"><img src="<?php echo $urlThemeActive ?>/assets/images/fixMobileHome.png" alt="">Trang chủ</a>
			<a href="javascript:void(0);" class="box-icon-cart "><span class="clsFlexCenterMid count-number-order count-number-order-mobile"><?php echo  @count($_SESSION['orderProducts']) ?></span><img src="<?php echo $urlThemeActive ?>/assets/images/fixMobileGiohang.png" alt="">Giỏ hàng</a>
			<a href="<?php echo $urlHomes ?>allProduct"><img src="<?php echo $urlThemeActive ?>/assets/images/fixMobileDichvu.png" alt="">Sản phẩm</a>
		</div>
	</div>
	<div class="wr-cart">
		<div>
			<div class="clsFlexBetweenMid cart-tool-bar">
				<span>Giỏ hàng</span>
				<button class="colse-cart-mobile" type="button"><i class="fas fa-times"></i></button>
			</div>
			<ul class="box-item-cart">
				<?php 
				$total = 0;
				if(isset($_SESSION['orderProducts']) && !empty($_SESSION['orderProducts'])) {
					foreach ($_SESSION['orderProducts'] as $key => $value) {
					$total += $value['Merchandise']['price']*$value['Merchandise']['numberOrder'];
					?>
					<li class="clsFlexBetween item-cart">
						<a class="box-cart-img" href="<?php echo @$urlHomes.'product/'.$value['Merchandise']['urlSlug'].'.html' ?>">
							<img src="<?php echo @$value['Merchandise']['image'] ?>" alt="">
						</a>
						<div class="info-item-cart">
							<div class="clsFlexBetween title-item-cart">
								<a class="" href="<?php echo @$urlHomes.'product/'.$value['Merchandise']['urlSlug'].'.html' ?>"><?php echo @$value['Merchandise']['name'] ?></a>
								<i onclick="deleteItem(<?php echo @$key ?>,this)" class="fas fa-times"></i>
							</div>
							<p><span class="numberUpdate<?php echo @$key ?>"><?php echo @$value['Merchandise']['numberOrder'] ?></span> x <span class="price-item-cart"><?php echo @number_format($value['Merchandise']['price'],0,',','.') ?></span> VNĐ</p>
							<div class="box-quanlyti noselect">
								<span onclick="updateOrderDow(this,<?php echo @$key ?>)">-</span>
								<input oninput="validity.valid||(value='1');" onchange="updateOrder(this,<?php echo @$key ?>)" class="numberUpdateInput<?php echo @$key ?>" type="number" min="1" value="<?php echo @$value['Merchandise']['numberOrder'] ?>">
								<span onclick="updateOrderUp(this,<?php echo @$key ?>)">+</span>
							</div>
						</div>
					</li>
					<?php
					}
				} ?>
			</ul>
		</div>
		<div class="wr-cart-footer">
			<div class="cart-total">TỔNG THANH TOÁN
				<p><span class="total-price"><?php echo @number_format($total,0,',','.'); ?></span> VNĐ</p>
			</div>
			<button class="thanhToan" type="button" <?php echo !empty($_SESSION['orderProducts'])?'':'disabled';?>>THANH TOÁN</button>
		</div>
	</div>
	<div class="wr-thanh-toan">
		<div>
			<div class="clsFlexBetweenMid cart-tool-bar">
				<span>Thông tin nhận hàng</span>
				<button class="colse-cart-mobile" type="button"><i class="fas fa-times"></i></button>
			</div>
			<div class="row form-thanh-toan">
				<div class="col-12">
					<input type="text" maxlength="255" required="" name="fullname" id="hoten" placeholder="Họ và tên">
				</div>
				<div class="col-12">
					<input type="number" name="phone" id="sdt" maxlength="11" required="" placeholder="Số điện thoại">
				</div>
				<div class="col-12">
					<input type="email" name="email" id="email" required="" placeholder="Email">
				</div>
				<div class="col-12">
					<input type="text" maxlength="255" required="" name="address" id="diachi" placeholder="Địa chỉ">
				</div>
				<div class="col-12">
					<textarea id="ghichu" name="note" rows="5" maxlength="3000" placeholder="Ghi chú"></textarea>
				</div>
			</div>
		</div>
		<div class="wr-cart-footer">
			<div class="cart-total">TỔNG THANH TOÁN
				<p><span class="total-price"><?php echo @number_format($total,0,',','.'); ?></span> VNĐ</p>
			</div>
			<button onclick="thanhToan(this)" type="button" <?php echo !empty($_SESSION['orderProducts'])?'':'disabled';?>>XÁC NHẬN</button>
		</div>
	</div>

	<div class="modal fade" id="modalSetOrder">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title">ĐẶT HẸN</div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="">
						<div>
							<input id="fullName" type="text" placeholder="Họ và tên">
						</div>
						<div>
							<input id="phone" type="number" placeholder="Số điện thoại">
						</div>
						<div>
							<input id="dateSet" type="datetime-local" placeholder="Ngày hẹn">
						</div>
						<div>
							<textarea id="note" rows="4" placeholder="Nội dung"></textarea>
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn-sendOrder" onclick="setOrder()">Gửi</button>
				</div>

			</div>
		</div>
	</div>
</body>


<script src="<?php echo $urlThemeActive ?>assets/lib/jquery/jquery-3.2.1.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/flickity-docs/flickity.pkgd.min.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/fancybox.umd.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/carousel.umd.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fontawesome-free-5.15.1-web/js/all.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/grid-gallery-master/js/grid-gallery.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/jQuery-Plugin-For-Responsive-Justified-Image-Gallery-Justified/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/jQuery-Plugin-For-Responsive-Justified-Image-Gallery-Justified/dist/js/justified.js"></script>

<script src="<?php echo $urlThemeActive ?>assets/js/js.js"></script>

</html>