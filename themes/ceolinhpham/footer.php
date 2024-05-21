<?php $setting = setting(); ?>

		<section class="bando_main">
			<p><center>Website được xây dựng bởi <a href="https://2top.vn/" title="Công cụ tạo web tự động">Top Top</a></center></p>
		</section>


		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="<?php echo $urlThemeActive; ?>js/jquery-slim.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/popper.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/bootstrap.min.js"></script>
		<!-- fontawesome -->
		<script src="<?php echo $urlThemeActive; ?>js/all.min.js"></script>
		<!-- owl-carousel -->
		<script src="<?php echo $urlThemeActive; ?>js/owl.carousel.min.js"></script>
		<!-- js web page -->
		<script src="<?php echo $urlThemeActive; ?>js/main.js"></script>

		<?php echo @$setting['messenger']; ?>
	</body>
</html>