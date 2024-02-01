<?php $setting = setting();?>
		<div class="text-center" style="width:50%; margin-left: 25%;">
			<hr style="border :1px solid #770000">
		</div>

		<section class="section6" id="lienhe">
			<div class="textfooter">
				<h1>KẾT NỐI VỚI TÔI</h1>
			<p>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-6523dd4" href="<?php echo @$setting['facebook']; ?>" target="_blank"><i class="fab fa-facebook-square" style="font-size: 50px; color: #3b5998"></i></a>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-3e1d47d" href="<?php echo @$setting['instagram']; ?>" target="_blank"><i class="fab fa-instagram-square" style="font-size:50px; color: #993300"></i></a>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-repeater-item-ab3a1de" href="<?php echo @$setting['youtube']; ?>" target="_blank"><i class="fab fa-youtube-square" style="font-size: 50px;color: #cd201f;"></i></a>
			</p>
			</div>
			<div class="container">
				<div class="bando">
					<?php echo @$setting['map'];?>
				</div>
				
				
			</div>
			<br/>
			<p><center>Website được xây dựng bởi <a href="https://2top.vn/" title="Công cụ tạo web tự động">Phoenix Tech</a></center></p>
			
		</section>






		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/jquery-slim.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/popper.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/bootstrap.min.js"></script>
		<!-- fontawesome -->
		<script src="<?php echo $urlThemeActive; ?>js/all.min.js"></script>
		<!-- owl-carousel -->
		<script src="<?php echo $urlThemeActive; ?>js/owl.carousel.min.js"></script>
		<!-- js web page -->
		<script src="<?php echo $urlThemeActive; ?>js/main.js"></script>
		

		<script type="text/javascript">

			var a = 0;
			$(window).scroll(function() {

				var oTop = $('#counter').offset().top - window.innerHeight;
				if (a == 0 && $(window).scrollTop() > oTop) {
					$('.counter-value').each(function() {
						var $this = $(this),
						countTo = $this.attr('data-count');
						$({
							countNum: $this.text()
						}).animate({
							countNum: countTo
						},

						{

							duration: 2000,
							easing: 'swing',
							step: function() {
								$this.text(Math.floor(this.countNum));
							},
							complete: function() {
								$this.text(this.countNum);
            //alert('finished');
        }

    });
					});
					a = 1;
				}

			});
		</script>



		<script type="text/javascript" >
			//animate service
			$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.img_myduyen').offset().top;

					if (pos_body>pos_event-300){
						$('.img_myduyen').addClass('animate__animated animate__rollIn');
					}
				});
			});

			$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.content').offset().top;

					if (pos_body>pos_event-300){
						$('.content').addClass('animate__animated animate__backInRight');
					}
				});
			});
				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.myduyenh1').offset().top;

					if (pos_body>pos_event-300){
						$('.myduyenh1').addClass('animate__animated animate__backInDown');
					}
				});
			});
				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.daotao').offset().top;

					if (pos_body>pos_event-700){
						$('.daotao').addClass('animate__animated animate__fadeInDownBig');
					}
				});
			});

				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.daotao1').offset().top;

					if (pos_body>pos_event-700){
						$('.daotao1').addClass('animate__animated animate__fadeInUp');
					}
				});
			});
		</script>
		<?php echo @$setting['messenger'];?>
	</body>
</html>