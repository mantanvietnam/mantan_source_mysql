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
	@media only screen and (max-width: 767px) {
	.wrapper-full {
		padding: 0 15px;
	}
	}
</style>
<main>
	<section class="wrapper-full">
		
			<div class="wrapper-user">
				<div class="head-tab text-center">
					<ul>
						<li>
							<a href="javascript:void(0)" data-tab="tab-1" class="active">
								<svg xmlns="http://www.w3.org/2000/svg" width="529" height="61" viewBox="0 0 529 61" fill="none">
									<path d="M528.161 60.7202H0.53125V30.6699C0.53125 14.1599 13.9113 0.779785 30.4213 0.779785H498.271C514.781 0.779785 528.161 14.1599 528.161 30.6699V60.7202Z" fill="#003B75"/>
								</svg>
								<span><?php echo $post->title;?></span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content-user">
					<div class="content-tab active" id="tab-1">
						<div class="list-gallery">
							<div class="row info mb-3">
								<div class="date-post mr-3"><?php echo date('d/m/Y', $post->time);?></div>
								<div class="date-author"><?php echo $post->author;?></div>
							</div>
							<div class="row">
								<?php echo $post->content;?>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		
	</section>
</main>
<?php getFooter();?>