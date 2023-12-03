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
	.article {
		margin: 30px 0;
		color: #000;
	}
	.post-meta h1 {
		font-size: 28px;
		line-height: 35px;
	}

	span.date-post {
		color: #777777;
		font-size: 15px;
	}

	.post-meta {
		margin-bottom: 28px;
		border-bottom: 1px dotted #ebebeb;
		padding-bottom: 5px;
	}

	.post-content img {
		max-width: 100% !important;
		height: auto !important;
		margin: 0 auto;
		display: block;
	}

	.post-content h2 {
		font-size: 26px;
		line-height: 32px;
		display: block;
		padding: 10px 0;
	}

	.post-content h3 {
		font-size: 23px;
		line-height: 32px;
		display: block;
		padding: 10px 0;
	}

	.post-content h4 {
		font-size: 21px;
		line-height: 32px;
		display: block;
		padding: 10px 0;
	}

	.related-posts {
		margin-top: 25px;
	}

	strong.title-related-post {
		font-weight: 600;
		font-size: 22px;
		display: block;
		margin-bottom: 10px;
	}

	.related-posts ul {
		margin-left: 20px;
	}

	.related-posts ul li {
		padding: 3px 0;
	}

	.single-menu ul.news-menu {
		white-space: nowrap;
   		overflow-x: auto;
   		overflow-y: hidden;
		text-align: center;
	}

	ul.news-menu::-webkit-scrollbar {
		display: none;
	}

	.single-menu ul.news-menu li {
		display: inline-block;
		background: rgb(244,152,30);
		background: linear-gradient(101deg, rgba(244,152,30,1) 0%, rgba(147,68,137,1) 55%, rgba(0,118,190,1) 99%);
		border-radius: 100px;
		margin: 5px;
		transition: all .2s ease-in-out;
	}

	.single-menu ul.news-menu li a {
		color: #fff;
		display: block;
		padding: 10px 18px;
		font-size: 18px;
	}

	.single-menu {
		margin-top: 25px;
	}

	.single-menu ul.news-menu li:hover {
		transition: all .2s ease-in-out;
		transform: scale(1.05);
	}

	.single-social-share ul li img {
		width: 30px;
	}

	.single-bottom {
		border-top: 1px dotted #ebebeb;
		margin-top: 20px;
		padding-top: 10px;
		display: flex;
		align-items: center;
	}

	.single-social-share ul {
		list-style: none;
		display: flex;
	}

	.single-social-share ul li {
		margin-right: 10px;
	}

	.single-social-share {
		width: 50%;
	}
	.post-author {
		width: 50%;
		text-align: right;
	}

	.sidebar-ads {
		margin: 30px 0;
	}

	.sidebar-ads {
		display: block;
	}
	@media only screen and (max-width: 767px) {
		
	main {margin-top: 80px;}
	.sidebar-ads {display: none;}

	}
</style>
<main>
	<div class="container">
		<div class="single-menu">
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

		<div class="row">
			<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
				<div class="article">
					<div class="post-meta">
						<h1><?php echo $post->title;?></h1>
						<span class="date-post">Ngày cập nhật: <?php echo date('d/m/Y', $post->time);?></span>
					</div>
					<div class="post-content">
						<?php echo $post->content;?>	
						
						<div class="single-bottom">
							<div class="single-social-share">
								<ul>
									<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo @$settingThemes['facebook'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/facebook.png" class="img-fluid btn-effect" alt=""></a></li>
									<li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/youtube.png" class="img-fluid btn-effect" alt=""></a></li>                              
									<li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/telegram.png" class="img-fluid btn-effect" alt=""></a></li>                               
									<li><a href="<?php echo @$settingThemes['instagram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/instagram.png" class="img-fluid btn-effect" alt=""></a></li>                               
									<li><a href="https://twitter.com/intent/tweet?text=Ngày 20/11 với Lòng biết ơn vô hạn&amp;url=<?php echo @$settingThemes['twitter'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/twitter.png" class="img-fluid btn-effect" alt=""></a></li>
								</ul>
							</div>
							<div class="post-author">Tác giả: <strong><?php echo $post->author;?></strong></div>		
						</div>								
					</div>

					<div class="related-posts">
						<strong class="title-related-post">Tin tức liên quan</strong>
						<ul>
							<?php 
							if(!empty($otherPosts)){
								foreach ($otherPosts as $key => $value) {
									$link = '/'.$value->slug.'.html';

									echo '<li><a href="'.$link.'">'.$value->title.'</a></li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>	
			<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
				<div class="sidebar-ads">
					<a href="#"><img src="https://i.pinimg.com/originals/f2/c6/71/f2c6717859921909a724f6f449a28d52.jpg" width="100%"></a>	
					<a href="#"><img src="https://i.pinimg.com/564x/c8/db/34/c8db346be51a73b50b53ce8546a9e10b.jpg		" width="100%"></a>			
				</div>		
			</div>
		</div>	
	</div>
</main>
<?php getFooter();?>