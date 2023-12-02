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

	.post-author {
		border-top: 1px dotted #ebebeb;
		margin-top: 20px;
		padding-top: 10px;
		text-align: right;
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

	@media only screen and (max-width: 767px) {
	main {
		margin-top: 80px;
	}
	}
</style>
<main>
	<div class="container">
		<div class="article">
			<div class="post-meta">
				<h1><?php echo $post->title;?></h1>
				<span class="date-post">Ngày cập nhật: <?php echo date('d/m/Y', $post->time);?></span>
			</div>
			<div class="post-content">
				<?php echo $post->content;?>	
						
				<div class="post-author">Tác giả: <strong><?php echo $post->author;?></strong></div>									
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
</main>
<?php getFooter();?>