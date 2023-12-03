<?php getHeader();?>
<style>
	body {
		background: #fff !important;
	}
	footer {
		margin-top: 30px;
		position: static !important;
	}
	main {
		height: auto !important;
	}
	.top-news {
		margin-top: 39px;
	}

	.content-news {
   		 margin-top: 30px;
	}
	ul.news-menu li {
    padding: 10px 0;
    border-bottom: 1px solid #adadad;
	}

	ul.news-menu li a {
		font-size: 18px;
	}

	ul.news-menu li a.active {
		color: #0387FF;
	}

	@keyframes pulse {
                    0% {
                        transform: scale(1);
                    }


                    50% {
                        transform: scale(0.9);
                    }

                    100% {
                        transform: scale(1)
                    }
    }

	#top-news-row .item-news-wrap:first-child .item-news:before, #top-news-row .item-news-wrap:nth-child(2) .item-news:before, #top-news-row .item-news-wrap:nth-child(3) .item-news:before {
		content: "NEW";
		position: absolute;
		right: 5px;
		top: 5px;
		z-index: 999;
		animation: 0.5s infinite pulse;
		color: #fff;
		font-weight: 900;
		background: #FF0000;
		width: 42px;
		height: 42px;
		text-align: center;
		line-height: 45px;
		border-radius: 100%;
		font-size: 13px;
	}

	.slider {
	margin: 0 auto;
	max-width: 100%;
	}

	.slide_viewer {
	height: 476px;
	overflow: hidden;
	position: relative;
	}

	.slide_group {
	height: 100%;
	position: relative;
	width: 100%;
	}

	.slide {
	display: none;
	height: 100%;
	position: absolute;
	width: 100%;
	}

	.slide:first-child {
	display: block;
	}

	.slide:nth-of-type(1) {
	background: #D7A151;
	}

	.slide:nth-of-type(2) {
	background: #F4E4CD;
	}

	.slide:nth-of-type(3) {
	background: #C75534;
	}

	.slide:nth-of-type(4) {
	background: #D1D1D4;
	}

	.slide_buttons {
	left: 0;
	position: absolute;
	right: 0;
	text-align: center;
	bottom: 0;
	}

	a.slide_btn {
	color: #474544;
	font-size: 42px;
	margin: 0 0.175em;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
	-ms-transition: all 0.4s ease-in-out;
	-o-transition: all 0.4s ease-in-out;
	transition: all 0.4s ease-in-out;
	}
	a.slide_btn.active, .slide_btn:hover {
		color: #a3a3a3;
		cursor: pointer;
	}

	.directional_nav {
	height: 340px;
	margin: 0 auto;
	max-width: 940px;
	position: relative;
	top: -340px;
	}

	.previous_btn {
	bottom: 0;
	left: 100px;
	margin: auto;
	position: absolute;
	top: 0;
	}

	.next_btn {
	bottom: 0;
	margin: auto;
	position: absolute;
	right: 100px;
	top: 0;
	}

	.previous_btn, .next_btn {
	cursor: pointer;
	height: 65px;
	opacity: 0.5;
	-webkit-transition: opacity 0.4s ease-in-out;
	-moz-transition: opacity 0.4s ease-in-out;
	-ms-transition: opacity 0.4s ease-in-out;
	-o-transition: opacity 0.4s ease-in-out;
	transition: opacity 0.4s ease-in-out;
	width: 65px;
	}

	.previous_btn:hover, .next_btn:hover {
	opacity: 1;
	}
	#top-news-mb {
		display: none;
	}
	#top-news-pc {
		display: block;
	}

	@media only screen and (max-width: 767px) {
	#top-news-mb {
		display: block;
		margin-top: 60px;
	}
	#top-news-pc {
		display: none;
	}
	.previous_btn {
		left: 50px;
	}
	.next_btn {
		right: 50px;
	}
	.wrapper-full {
		padding: 0 15px;
	}
	.top-news {
		margin-top: 0px;
		margin-bottom: 20px;
	}
	}

	.item-news {
		position: relative;
		overflow: hidden;
		margin-bottom: 15px;
	}
	.news-title {
		position: absolute;
		bottom: 0;
		background: rgba(0,0,0,0.5);
		padding: 5px;
		width: 100%;
		min-height: 48px;
	}

	.news-thumb img {
		transition: all .2s ease-in-out;
	}

	.item-news:hover .news-thumb img {
		transition: all .2s ease-in-out;
		transform: scale(1.05);
	}

	.news-title a {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 2; /* number of lines to show */
				line-clamp: 2; 
		-webkit-box-orient: vertical;
	}

	.news-title a {
		color: #fff;		
	}

	.news-title h2 {
		font-size: 16px;
		text-transform: uppercase;
		line-height: 20px;
	}

	.pagination {
		margin: 30px 0;
	}

	.pagination a {
		color: #0065F7;
	}

	.pagination ul li a.active, .pagination ul li a:hover {
		color: #000;
	}

	swiper-container {
      width: 100%;
      height: 100%;
    }

    swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

	ul.news-menu-mb {
		white-space: nowrap;
   		overflow-x: auto;
   		overflow-y: hidden;
		text-align: center;
		background: #0F8DF4;
	}

	ul.news-menu-mb::-webkit-scrollbar {
		display: none;
	}

	ul.news-menu-mb li {
		display: inline-block;
		border-radius: 100px;
		margin: 5px;
		transition: all .2s ease-in-out;
	}
	ul.news-menu-mb li a {
		color: #fff;
		padding: 10px;
		display: block;
	}

</style>
<main>

	<div class="top-news" id="top-news-mb">
		<swiper-container class="mySwiper" pagination="true" pagination-clickable="true" loop="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">											
					<?php 
							if(!empty($slide_news)){
								foreach ($slide_news as $key => $value) {
									echo '	<swiper-slide>
												<a href="'.$value->link.'">
													<img src="'.$value->image.'">
												</a>
											</swiper-slide>';
								}
							}
					?>
			
		</swiper-container>
		<ul class="news-menu-mb">
					<?php 
						global $settingThemes;

						$menu = getMenusDefault($settingThemes['id_menu_news']);

						if(!empty($menu)){
							foreach($menu as $key => $value){
								if(!empty($value->sub)){
									echo '  <li>
												<a href="javascript:void(0);">
													'.$value->name.'
												</a>
												<div class="submenu">
													<ul>';

													foreach ($value->sub as $sub) {
														$active = '';
														if(strpos($urlCurrent, $sub->link) !== false){
															$active = 'active';
														}

														echo '<li><a href="'.$sub->link.'" class="'.$active.'">'.$sub->name.'</a></li>';
													}
									echo        '
													</ul>
												</div>
											</li>';
								}else{
									$active = '';
									if(strpos($urlCurrent, $value->link) !== false){
										$active = 'active';
									}

									echo '  <li>
												<a class="'.$active.'" href="'.$value->link.'">'.$value->name.'</a>
											</li>';
								}
							}
						}
					?>


		</ul>
		<div class="container">
		<div class="content-news">		
			<div class="list-news">
				<div class="row" id="top-news-row">
						<?php
						if(!empty($listPosts)){
							foreach ($listPosts as $key => $value) {
								$link = '/'.$value->slug.'.html';

								echo '	<div class="col-md-3 item-news-wrap">
											<div class="item-news">
												<div class="news-thumb">															
													<a href="'.$link.'"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a>
												</div>
												<div class="news-title">
														<h2><a href="'.$link.'">'.$value->title.'</a></h2>
												</div>
											</div>
										</div>';
							}
						}
						?>
				</div><!-- #row -->
			</div><!-- #list-news -->

			<div class="pagination">
				<ul>
					<?php
							if($totalPage>1){
								if ($page > 5) {
									$startPage = $page - 5;
								} else {
									$startPage = 1;
								}

								if ($totalPage > $page + 5) {
									$endPage = $page + 5;
								} else {
									$endPage = $totalPage;
								}
								
								echo '<li><a href="'.$urlPage.'1"><img src="/plugins/go_draw/view/agency/images/arr-left.svg" class="img-fluid" alt=""></a></li>';
								
								for ($i = $startPage; $i <= $endPage; $i++) {
									$active= ($page==$i)?'active':'';

									echo '<li><a href="'.$urlPage.$i.'" class="'.$active.'">'.$i.'</a></li>';
								}

								echo '<li><a href="'.$urlPage.$totalPage.'"><img src="/plugins/go_draw/view/agency/images/arr-right.svg" class="img-fluid"></a></li>';
							}
					?>
				</ul>
			</div> <!-- #pagination -->
		</div>	<!-- #content-news -->
		</div>
	</div>	

	<div class="container">
		<div class="top-news" id="top-news-pc">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">	
					<ul class="news-menu">
						<?php 
							global $settingThemes;

							$menu = getMenusDefault($settingThemes['id_menu_news']);

							if(!empty($menu)){
								foreach($menu as $key => $value){
									if(!empty($value->sub)){
										echo '  <li>
													<a href="javascript:void(0);">
														'.$value->name.'
													</a>
													<div class="submenu">
														<ul>';

														foreach ($value->sub as $sub) {
															$active = '';
															if(strpos($urlCurrent, $sub->link) !== false){
																$active = 'active';
															}

															echo '<li><a href="'.$sub->link.'" class="'.$active.'">'.$sub->name.'</a></li>';
														}
										echo        '
														</ul>
													</div>
												</li>';
									}else{
										$active = '';
										if(strpos($urlCurrent, $value->link) !== false){
											$active = 'active';
										}

										echo '  <li>
													<a class="'.$active.'" href="'.$value->link.'">'.$value->name.'</a>
												</li>';
									}
								}
							}
						?>


					</ul>
				</div><!-- End menu -->
				<div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">	
					<swiper-container class="mySwiper" pagination="true" pagination-clickable="true" loop="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">											
						<?php 
								if(!empty($slide_news)){
									foreach ($slide_news as $key => $value) {
										echo '	<swiper-slide>
													<a href="'.$value->link.'">
														<img src="'.$value->image.'">
													</a>
												</swiper-slide>';
									}
								}
						?>
				
					</swiper-container>
					<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
					
				</div>			
			</div><!-- #End row -->
		<div><!-- #End Topnews -->


		<div class="content-news">		
			<div class="list-news">
				<div class="row" id="top-news-row">
						<?php
						if(!empty($listPosts)){
							foreach ($listPosts as $key => $value) {
								$link = '/'.$value->slug.'.html';

								echo '	<div class="col-md-3 item-news-wrap">
											<div class="item-news">
												<div class="news-thumb">															
													<a href="'.$link.'"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a>
												</div>
												<div class="news-title">
														<h2><a href="'.$link.'">'.$value->title.'</a></h2>
												</div>
											</div>
										</div>';
							}
						}
						?>
				</div><!-- #row -->
			</div><!-- #list-news -->

			<div class="pagination">
				<ul>
					<?php
							if($totalPage>1){
								if ($page > 5) {
									$startPage = $page - 5;
								} else {
									$startPage = 1;
								}

								if ($totalPage > $page + 5) {
									$endPage = $page + 5;
								} else {
									$endPage = $totalPage;
								}
								
								echo '<li><a href="'.$urlPage.'1"><img src="/plugins/go_draw/view/agency/images/arr-left.svg" class="img-fluid" alt=""></a></li>';
								
								for ($i = $startPage; $i <= $endPage; $i++) {
									$active= ($page==$i)?'active':'';

									echo '<li><a href="'.$urlPage.$i.'" class="'.$active.'">'.$i.'</a></li>';
								}

								echo '<li><a href="'.$urlPage.$totalPage.'"><img src="/plugins/go_draw/view/agency/images/arr-right.svg" class="img-fluid"></a></li>';
							}
					?>
				</ul>
			</div> <!-- #pagination -->
		</div>	<!-- #content-news -->
								

	</div> <!-- #container -->					
</main>
<?php getFooter();?>

