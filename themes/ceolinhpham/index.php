
<?php getHeader(); ?>

		<section class="banner_main" style="background-image: url(<?php echo @$setting['videoBanner']; ?>);background-size: 100%;
    background-repeat: no-repeat;">
			<!-- <video autoplay loop muted>
		    	<source type="video/mp4" src="<?php echo @$setting['videoBanner']; ?>">
			</video> -->
			<div class="banner_dem"></div>
			<div class="container">
				<div class="row banner_content">
					<div class="col-md-6 text-center banner_text">
						<span class="co_dinh">TÔI LÀ</span>
						<span class="chu_ky">
							<?php echo @$setting['sloganBanner1']; ?>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path></svg>
						</span>
						<h2><?php echo @$setting['sloganBanner2']; ?></h2>
						<p><i class="<?php echo @$setting['iconBanner']; ?>"></i></p>
						<h4 class="animate__animated animate__backInUp"><?php echo @$setting['sloganBanner3']; ?></h4>
						<a href="<?php echo @$setting['linkBanner']; ?>" class="btn btn-warning"><i class="fas fa-arrow-circle-right"></i> CÂU CHUYỆN CỦA TÔI</a>
					</div>
					<div class="col-md-6 text-center">
						<img src="<?php echo @$setting['imageBanner']; ?>" width="100%">
					</div>
				</div>
			</div>
			<div class="elementor-shape elementor-shape-bottom" data-negative="false" style="margin-top: -48px">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
					<path class="elementor-shape-fill" d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"></path>
					<path class="elementor-shape-fill" d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z"></path>
					<path class="elementor-shape-fill" d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z"></path>
					<path class="elementor-shape-fill" d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z"></path>
					<path class="elementor-shape-fill" d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z"></path>
					<path class="elementor-shape-fill" d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z"></path>
					<path class="elementor-shape-fill" d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"></path>
					<path class="elementor-shape-fill" d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z"></path>
					<path class="elementor-shape-fill" d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z"></path>
				</svg>		
			</div>
		</section>


		<section class="intro_main" id="gioithieu">
			<div class="text-center intro_text">
				<h1 class="heading">
					<span><?php echo @$setting['fullName']; ?></span>
				</h1>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div style="margin-top: 20px" class="col-3 col-sm-3 col-md-2 intro_img">
								<img src="<?php echo @$setting['imageIntro']; ?>" alt="" width="100%">
							</div>
							<div class="col-9 col-sm-9 col-md-10">
								<p>
									<?php echo @$setting['contentIntro']; ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center intro_right">
						<p> <i>KẾT NỐI QUA MẠNG XÃ HỘI</i> </p>
						<ul class="logo_mxh">
							<li class="logo_fb">
								<a href="<?php echo @$setting['facebook']; ?>"><i class="fab fa-facebook"></i></a>
							</li>
							<li class="logo_youtobe">
								<a href="<?php echo @$setting['youtube']; ?>"><i class="fab fa-youtube"></i></a>
							</li>
							<li class="logo_instagram">
								<a href="<?php echo @$setting['instagram']; ?>"><i class="fab fa-instagram"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>


		<section class="event_main" id="sukien" style="background-image: url('<?php echo @$setting['imageBgEvent']; ?>')">
			<div class="container">
				<div class="row">
					<div class="col-md-4 event_item">
						<div class="flip-card">
						  	<div class="flip-card-inner">
						    	<div class="flip-card-front">
						      		<div class="item_img">
						      			<img src="<?php echo @$setting['imageEvent1']; ?>" width="100%">
						      		</div>
						      		<div class="item_text">
						      			<p><i class="<?php echo @$setting['iconEvent1']; ?>"></i></p>
						      			<h5><?php echo @$setting['titleEvent1']; ?></h5>
						      		</div>
						    	</div>
						    	<div class="flip-card-back">
						      		<div class="item_img_hover">
						      			<img src="<?php echo @$setting['imageEventHover1']; ?>" width="100%">
						      		</div>
						      		<div class="item_text_hover">
						      			<a href="<?php echo @$setting['linkEvent1']; ?>" class="btn btn-outline-light">CHI TIẾT SỰ KIỆN</a>
						      		</div>
						    	</div>
						  	</div>
						</div>
					</div>
					<div class="col-md-4 event_item">
						<div class="flip-card">
						  	<div class="flip-card-inner">
						    	<div class="flip-card-front">
						      		<div class="item_img">
						      			<img src="<?php echo @$setting['imageEvent2']; ?>" width="100%">
						      		</div>
						      		<div class="item_text">
						      			<p><i class="<?php echo @$setting['iconEvent2']; ?>"></i></p>
						      			<h5><?php echo @$setting['titleEvent2']; ?></h5>
						      		</div>
						    	</div>
						    	<div class="flip-card-back">
						      		<div class="item_img_hover">
						      			<img src="<?php echo @$setting['imageEventHover2']; ?>" width="100%">
						      		</div>
						      		<div class="item_text_hover">
						      			<a href="<?php echo @$setting['linkEvent2']; ?>" class="btn btn-outline-light">CHI TIẾT SỰ KIỆN</a>
						      		</div>
						    	</div>
						  	</div>
						</div>
					</div>
					<div class="col-md-4 event_item">
						<div class="flip-card">
						  	<div class="flip-card-inner">
						    	<div class="flip-card-front">
						      		<div class="item_img">
						      			<img src="<?php echo @$setting['imageEvent3']; ?>" width="100%">
						      		</div>
						      		<div class="item_text">
						      			<p><i class="<?php echo @$setting['iconEvent3']; ?>"></i></p>
						      			<h5><?php echo @$setting['titleEvent3']; ?></h5>
						      		</div>
						    	</div>
						    	<div class="flip-card-back">
						      		<div class="item_img_hover">
						      			<img src="<?php echo @$setting['imageEventHover3']; ?>" width="100%">
						      		</div>
						      		<div class="item_text_hover">
						      			<a href="<?php echo @$setting['linkEvent3']; ?>" class="btn btn-outline-light">CHI TIẾT SỰ KIỆN</a>
						      		</div>
						    	</div>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="blog_main" id="tintuc">
			<div class="container">
				<h4 class="text-center">Tin Tức Mới Nhất</h4>
				<div class="row blog_animation">
					<?php
						if(!empty($listDataNew)){
							foreach($listDataNew as $item){
								echo '
								<div class="col-12 col-sm-6 col-md-6 col-lg-3">
									<div class="blog_item">
										<div class="blog_item_bg" style="background-image: url('.$item->image.')">
											<div class="blog_item_img"></div>
										</div>
										<div class="blog_item_text">
											<a href="/'.@$item->slug.'.html"><p>'.@$item->title.'</p></a>
										</div>
									</div>
								</div>';
							}
						}
					?>
				</div>
			</div>
		</section>s

		<footer class="footer_main" id="hoatdong" style="background-image: url('<?php echo @$setting['imageBgNewpaper']; ?>')">
			<div class="elementor-shape elementor-shape-top" data-negative="false">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
					<path class="elementor-shape-fill" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"/>
					<path class="elementor-shape-fill" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"/>
					<path class="elementor-shape-fill" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"/>
				</svg>		
			</div>
			<div class="container">
				<h3 class="text-center">TRUYỀN THÔNG VÀ BÁO CHÍ</h3>
				<div class="row">
					<div class="col-md-4 text-center resp_768">
						<div class="footer_item">
							<a href="<?php echo @$setting['linkNewspaper3']; ?>">
								<img src="<?php echo @$setting['imageNewspaper1']; ?>" width="100%">
							</a>
							<div class="footer_item_text">
								<a href="<?php echo @$setting['linkNewspaper1']; ?>">
									<b><?php echo @$setting['titleNewspaper1']; ?></b>
									<p><?php echo @$setting['textNewspaper1']; ?></p>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center resp_768">
						<div class="footer_item">
							<a href="<?php echo @$setting['linkNewspaper2']; ?>">
								<img src="<?php echo @$setting['imageNewspaper2']; ?>" width="100%">
							</a>
							<div class="footer_item_text">
								<a href="<?php echo @$setting['linkNewspaper2']; ?>">
									<b><?php echo @$setting['titleNewspaper2']; ?></b>
									<p><?php echo @$setting['textNewspaper2']; ?></p>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center resp_768">
						<div class="footer_item">
							<a href="<?php echo @$setting['linkNewspaper3']; ?>">
								<img src="<?php echo @$setting['imageNewspaper3']; ?>" width="100%">
							</a>
							<div class="footer_item_text">
								<a href="<?php echo @$setting['linkNewspaper3']; ?>">
									<b><?php echo @$setting['titleNewspaper3']; ?></b>
									<p><?php echo @$setting['textNewspaper3']; ?></p>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="elementor-shape elementor-shape-bottom2" data-negative="false">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
					<path class="elementor-shape-fill" d="M761.9,44.1L643.1,27.2L333.8,98L0,3.8V0l1000,0v3.9"/>
				</svg>
			</div>
		</footer>

<?php getFooter(); ?>