<?php getHeader();?>
<style>
	.wrapper-full {
		padding: 0 46px;
	}
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
    padding: 16px 0;
    border-bottom: 1px solid #adadad;
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

	@media only screen and (max-width: 767px) {
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
		margin-top: 60px;
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

</style>
<main>
	
	<div class="wrapper-full">
		<div class="top-news">
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
				<div class="slider">
					<div class="slide_viewer">
						<div class="slide_group">
							<?php 
							if(!empty($slide_news)){
								foreach ($slide_news as $key => $value) {
									echo '	<div class="slide">
												<a href="'.$value->link.'">
													<img src="'.$value->image.'">
												</a>
											</div>';
								}
							}
							?>
						</div>
					</div>
					<div class="slide_buttons"></div>
				</div><!-- End // .slider -->	
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
				<script>
					$('.slider').each(function() {
					var $this = $(this);
					var $group = $this.find('.slide_group');
					var $slides = $this.find('.slide');
					var bulletArray = [];
					var currentIndex = 0;
					var timeout;
					
					function move(newIndex) {
						var animateLeft, slideLeft;
						
						advance();
						
						if ($group.is(':animated') || currentIndex === newIndex) {
						return;
						}
						
						bulletArray[currentIndex].removeClass('active');
						bulletArray[newIndex].addClass('active');
						
						if (newIndex > currentIndex) {
						slideLeft = '100%';
						animateLeft = '-100%';
						} else {
						slideLeft = '-100%';
						animateLeft = '100%';
						}
						
						$slides.eq(newIndex).css({
						display: 'block',
						left: slideLeft
						});
						$group.animate({
						left: animateLeft
						}, function() {
						$slides.eq(currentIndex).css({
							display: 'none'
						});
						$slides.eq(newIndex).css({
							left: 0
						});
						$group.css({
							left: 0
						});
						currentIndex = newIndex;
						});
					}
					
					function advance() {
						clearTimeout(timeout);
						timeout = setTimeout(function() {
						if (currentIndex < ($slides.length - 1)) {
							move(currentIndex + 1);
						} else {
							move(0);
						}
						}, 4000);
					}
					
					$('.next_btn').on('click', function() {
						if (currentIndex < ($slides.length - 1)) {
						move(currentIndex + 1);
						} else {
						move(0);
						}
					});
					
					$('.previous_btn').on('click', function() {
						if (currentIndex !== 0) {
						move(currentIndex - 1);
						} else {
						move(3);
						}
					});
					
					$.each($slides, function(index) {
						var $button = $('<a class="slide_btn">&bull;</a>');
						
						if (index === currentIndex) {
						$button.addClass('active');
						}
						$button.on('click', function() {
						move(index);
						}).appendTo('.slide_buttons');
						bulletArray.push($button);
					});
					
					advance();
					});
				</script>			
			</div>			
		</div><!-- #End row -->
		<div><!-- #End Topnews -->

				
				
					
	</div>

	<div class="content-news">		
		<div class="list-news">
			<div class="row">
					<?php
					if(!empty($listPosts)){
						foreach ($listPosts as $key => $value) {
							$link = '/'.$value->slug.'.html';

							echo '	<div class="col-md-3">
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
			            if($totalPage>0){
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
	</div> <!-- #content-news -->

</main>
<?php getFooter();?>